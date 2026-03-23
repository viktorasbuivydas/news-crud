<?php

namespace App\Services;

use App\Enums\ArticleFilter;
use App\Models\Article;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ArticleService
{
    public function list(?ArticleFilter $filter = ArticleFilter::Published): LengthAwarePaginator
    {
        return Article::query()
            ->when($filter === ArticleFilter::Trashed, fn ($query) => $query->onlyTrashed())
            ->latest()
            ->paginate();
    }

    public function find(string $id, bool $withTrashed = false): Article
    {
        return $withTrashed
            ? Article::withTrashed()->findOrFail($id)
            : Article::findOrFail($id);
    }

    public function create(array $data): Article
    {
        return Article::query()->create($data);
    }

    public function update(string $id, array $data): Article
    {
        $article = Article::withTrashed()->findOrFail($id);
        $article->update($data);

        return $article;
    }

    public function delete(Article $article): void
    {
        $article->delete();
    }

    public function restore(string $id): Article
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->restore();

        return $article;
    }

    public function forceDelete(string $id): void
    {
        $article = Article::onlyTrashed()->findOrFail($id);
        $article->forceDelete();
    }
}
