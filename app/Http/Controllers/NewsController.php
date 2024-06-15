<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    
    public function index()
    {
        $articles = Article::query()->where('is_active', true)->latest()->paginate(15);
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
            $route = route('news.show', $tag->article);
            $text = preg_replace("/(\b$tag->name\b)((?!>)*<?)/iu", "<a href=\"$route\">$1</a>", $text);
        }

        return view('news.show', [
            'article' => $article,
            'text' => $text,
        ]);
    }
}
