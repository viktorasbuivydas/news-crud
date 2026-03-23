<?php

use App\Models\Article;

it('displays published articles on index', function () {
    $articles = Article::factory()->count(3)->create();

    $response = $this->get(route('articles.index'));

    $response->assertSuccessful();
    foreach ($articles as $article) {
        $response->assertSee($article->title);
    }
});

it('does not display trashed articles on index', function () {
    $article = Article::factory()->create();
    $trashedArticle = Article::factory()->create();
    $trashedArticle->delete();

    $response = $this->get(route('articles.index'));

    $response->assertSuccessful();
    $response->assertSee($article->title);
    $response->assertDontSee($trashedArticle->title);
});

it('shows a published article', function () {
    $article = Article::factory()->create();

    $response = $this->get(route('articles.show', $article));

    $response->assertSuccessful();
    $response->assertSee($article->title);
    $response->assertSee($article->content);
});

it('returns 404 for a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->get(route('articles.show', $article));

    $response->assertNotFound();
});
