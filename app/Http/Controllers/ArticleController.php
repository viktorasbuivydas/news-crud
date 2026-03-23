<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Models\Article;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function index(): View
    {
        $articles = Article::query()->latest()->paginate();

        return view('articles.index', compact('articles'));
    }

    public function show(Article $article): View
    {
        return view('articles.show', compact('article'));
    }

    public function create(): View
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = Article::query()->create($request->validated());

        return redirect()->route('articles.show', $article);
    }
}
