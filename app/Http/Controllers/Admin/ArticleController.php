<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Models\Article;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{

    protected function checkCollisions(array $tags, Article $article = null)
    {
        if ($article !== null) {
            $collisions = Tag::query()->whereNot(fn ($query) => $query->whereBelongsTo($article))->whereIn('name', $tags)->get();
        } else {
            $collisions = Tag::query()->whereIn('name', $tags)->get();
        }
        $collisions = $collisions->map(fn ($tag) => $tag->name)->toArray();

        if (count($collisions) > 0) {
            return back()->with('collisions', $collisions)->withInput()->withErrors([
                'tags' => 'Такі теги вже існують: '.implode(', ', $collisions),
            ]);
        }
        return false;
    }

    protected function updateTags(array $createdTags, array $removedTags, Article $article)
    {
        $words = [];
        if (preg_match_all('/\b([\p{L}\p{M}\p{N}]+)\b/u', $article->text, $words)) {
            $mentionedTags = Tag::query()->whereNot(fn ($query) => $query->whereBelongsTo($article))->whereIn('name', $words[0])->get();
            $article->mentionedTags()->sync($mentionedTags);
        }
        
        $createdTags = $article->tags()->createMany(array_map(fn ($tag) => ['name' => $tag], $createdTags));

        foreach ($createdTags as $tag) {
            $mentionedBy = Article::query()->where('id', '!=', $article->id)->whereFullText('text', $tag->name)->get();
            foreach ($mentionedBy as $model) {
                $model->mentionedTags()->attach($tag);
            }
        }

        $article->tags()->whereIn('name', $removedTags)->delete();
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Article::class);
        $title = 'Всі новини';
        $articles = Article::latest()->paginate(50);
        return view('admin.article.index', [
            'title' => $title,
            'articles' => $articles,
            'showAuthor' => true,
        ]);
    }

    public function indexMy(Request $request)
    {
        $title = 'Мої новини';
        $articles = Article::latest()->whereBelongsTo($request->user())->paginate(50);
        return view('admin.article.index', [
            'title' => $title,
            'articles' => $articles,
            'showAuthor' => false,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Article::class);
        return view('admin.article.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ArticleRequest $request)
    {
        $this->authorize('create', Article::class);

        $data = $request->validated();
        $data['is_active'] = boolval($data['is_active'] ?? false);
        $data['tags'] = $data['tags'] ?? [];

        if ($response = $this->checkCollisions($data['tags'])) return $response;


        $article = new Article($data);
        $article->editor()->associate($request->user());
        $article->save();

        $this->updateTags($data['tags'], [], $article);

        return redirect()->route('news.show', $article);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $this->authorize('update', $article);
        return view('admin.article.edit', [
            'article' => $article,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ArticleRequest $request, Article $article)
    {
        $this->authorize('update', $article);

        $data = $request->validated();
        $data['is_active'] = boolval($data['is_active'] ?? false);
        $data['tags'] = $data['tags'] ?? [];

        if ($response = $this->checkCollisions($data['tags'], $article)) return $response;

        $oldTags = $article->tags->map(fn ($tag) => $tag->name)->toArray();
        $createdTags = array_diff($data['tags'], $oldTags);
        $removedTags = array_diff($oldTags, $data['tags']);

        $article->fill($data);
        $article->save();

        $this->updateTags($createdTags, $removedTags, $article);

        return redirect()->route('news.show', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        $article->delete();
        if (url()->previous() === route('news.show', $article)) {
            return redirect()->route('home');
        } else {
            return back();
        }
    }
}
