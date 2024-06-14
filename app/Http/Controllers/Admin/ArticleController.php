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
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Article::class);
        $title = 'Всі новини';
        $articles = Article::paginate(50);
        return view('admin.article.index', [
            'title' => $title,
            'articles' => $articles,
            'showAuthor' => true,
        ]);
    }

    public function indexMy(Request $request)
    {
        $title = 'Мої новини';
        $articles = Article::query()->whereBelongsTo($request->user())->paginate(50);
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
        
        $collisions = Tag::query()->whereIn('name', $data['tags'])->get();
        $collisions = $collisions->map(fn ($tag) => $tag->name)->toArray();

        if (count($collisions) > 0) {
            return back()->with('collisions', $collisions)->withInput()->withErrors([
                'tags' => 'Такі теги вже існують: '.implode(', ', $collisions),
            ]);
        }

        $data['is_active'] = boolval($data['is_active'] ?? false);

        $article = new Article($data);
        $article->editor()->associate($request->user());
        $article->save();

        $article->tags()->createMany(array_map(fn ($tag) => ['name' => $tag], $data['tags']));

        return redirect()->route('articles.edit', $article);
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
        
        $collisions = Tag::query()->whereNot(fn ($query) => $query->whereBelongsTo($article))->whereIn('name', $data['tags'])->get();
        $collisions = $collisions->map(fn ($tag) => $tag->name)->toArray();

        if (count($collisions) > 0) {
            return back()->with('collisions', $collisions)->withInput()->withErrors([
                'tags' => 'Такі теги вже існують: '.implode(', ', $collisions),
            ]);
        }

        $data['is_active'] = boolval($data['is_active'] ?? false);

        $oldTags = $article->tags->map(fn ($tag) => $tag->name)->toArray();
        $createdTags = array_diff($data['tags'], $oldTags);
        $removedTags = array_diff($oldTags, $data['tags']);

        $article->fill($data);
        $article->save();
        $article->tags()->createMany(array_map(fn ($tag) => ['name' => $tag], $createdTags));
        $article->tags()->whereIn('name', $removedTags)->delete();

        return redirect()->route('articles.edit', $article);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $this->authorize('delete', $article);
        // TODO
    }
}
