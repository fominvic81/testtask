<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

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
        return view('news.show', [
            'article' => $article,
        ]);
    }
}
