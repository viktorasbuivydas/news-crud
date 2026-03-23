<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\ArticleFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Services\ArticleService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ArticleController extends Controller
{
    public function __construct(private ArticleService $articleService) {}

    public function index(Request $request): View
    {
        $requestedFilter = $request->query('filter', ArticleFilter::Published->value);
        $filter = ArticleFilter::tryFrom($requestedFilter) ?? ArticleFilter::Published;
        $articles = $this->articleService->list($filter);

        return view('articles.index', compact('articles', 'filter'));
    }

    public function create(): View
    {
        return view('articles.create');
    }

    public function store(StoreArticleRequest $request): RedirectResponse
    {
        $article = $this->articleService->create($request->validated());

        return redirect()->route('dashboard.articles.show', $article);
    }

    public function show(string $article): View
    {
        $article = $this->articleService->find($article, withTrashed: true);

        return view('articles.show', compact('article'));
    }

    public function edit(string $article): View
    {
        $article = $this->articleService->find($article, withTrashed: true);

        return view('articles.edit', compact('article'));
    }

    public function update(UpdateArticleRequest $request, string $article): RedirectResponse
    {
        $article = $this->articleService->update($article, $request->validated());

        return redirect()->route('dashboard.articles.show', $article);
    }

    public function destroy(Article $article): RedirectResponse
    {
        $this->articleService->delete($article);

        return redirect()->route('dashboard.articles.index', ['filter' => ArticleFilter::Trashed->value]);
    }

    public function restore(string $article): RedirectResponse
    {
        $article = $this->articleService->restore($article);

        return redirect()->route('dashboard.articles.show', $article);
    }

    public function forceDelete(string $article): RedirectResponse
    {
        $this->articleService->forceDelete($article);

        return redirect()->route('dashboard.articles.index', ['filter' => ArticleFilter::Trashed->value]);
    }
}
