<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    
    public function index()
    {
        $articles = Article::query()->where('is_active', true)->latest()->paginate();
        return view('news.index', [
            'articles' => $articles,
        ]);
    }

    public function show(Article $article)
    {
        if (!Auth::user()?->is_admin && Auth::user()?->id !== $article->editor->id && !$article->is_active) return abort(403);
        $tags = $article->mentionedTags;
        $text = e($article->text);

        foreach ($tags as $tag) {
            if (!$tag->article->is_active) continue;
            $route = route('news.show', $tag->article);
            $text = preg_replace("/(\b$tag->name\b)((?!>)*<?)/iu", "<a class=\"tag-link\" href=\"$route\">$1</a>", $text);
        }

        $prev = Article::where('is_active', true)->whereNot('id', $article->id)->where('created_at', '<',  $article->created_at)->latest()->first();
        $next = Article::where('is_active', true)->whereNot('id', $article->id)->where('created_at', '>=', $article->created_at)->oldest()->first();

        $prevRoute = app('router')->getRoutes()->match(app('request')->create(url()->previous()));
        $prevRouteName = $prevRoute->getName();

        $prevUrl = route('home');
        $prevTitle = 'Головна';

        if (url()->previous() !== url()->current()) {
            if ($prevRouteName === 'news.show' && $prevArticle = Article::find($prevRoute->parameters['article'])) {
                $prevUrl = route($prevRouteName, $prevRoute->parameters);
                $prevTitle = $prevArticle->title;
            } else if ($prevRouteName === 'articles.edit' && $prevArticle = Article::find($prevRoute->parameters['article'])) {
                $prevUrl = route('articles.edit', $prevRoute->parameters);
                $prevTitle = "Редагувати \"".$prevArticle->title."\"";
            } else if ($prevRouteName === 'articles.create') {
                $prevUrl = route('articles.edit', $article);
                $prevTitle = "Редагувати \"".$article->title."\"";
            }
        }

        return view('news.show', [
            'article' => $article,
            'text' => $text,
            'prev' => $prev,
            'next' => $next,
            'prevUrl' => $prevUrl,
            'prevTitle' => $prevTitle,
        ]);
    }
}
