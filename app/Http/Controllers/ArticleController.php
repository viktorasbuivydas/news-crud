<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::query()->latest()->paginate();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article): View
    {
        return view('articles.show', compact('article'));
    }

    public function create()
    {
        return view('articles.create');
    }
}
