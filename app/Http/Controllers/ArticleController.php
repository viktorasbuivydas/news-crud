<?php

namespace App\Http\Controllers;

use App\Services\ArticleService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService) {}

    public function index(Request $request): View
    {
        $articles = $this->articleService->list();

        return view('articles.index', compact('articles'));
    }

    public function show(string $article): View
    {
        $article = $this->articleService->find($article);

        return view('articles.show', compact('article'));
    }
}
