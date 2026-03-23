<?php

use App\Models\Article;
use App\Models\User;

beforeEach(function () {
    $this->user = User::factory()->create();
});

// Authentication

it('redirects guests to login', function () {
    $this->get(route('dashboard.articles.index'))
        ->assertRedirect(route('login'));
});

// Index

it('displays published articles by default', function () {
    $article = Article::factory()->create();
    $trashedArticle = Article::factory()->create();
    $trashedArticle->delete();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.index'));

    $response->assertSuccessful();
    $response->assertSee($article->title);
    $response->assertDontSee($trashedArticle->title);
});

it('displays only trashed articles with trashed filter', function () {
    $article = Article::factory()->create();
    $trashedArticle = Article::factory()->create();
    $trashedArticle->delete();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.index', ['filter' => 'trashed']));

    $response->assertSuccessful();
    $response->assertDontSee($article->title);
    $response->assertSee($trashedArticle->title);
});

it('falls back to published filter for invalid filter value', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.index', ['filter' => 'invalid']));

    $response->assertSuccessful();
    $response->assertSee($article->title);
});

// Show

it('shows a published article', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.show', $article));

    $response->assertSuccessful();
    $response->assertSee($article->title);
});

it('shows a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.show', $article));

    $response->assertSuccessful();
    $response->assertSee($article->title);
});

// Create & Store

it('displays the create form', function () {
    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.create'));

    $response->assertSuccessful();
});

it('stores a new article', function () {
    $response = $this->actingAs($this->user)
        ->post(route('dashboard.articles.store'), [
            'title' => 'Test Article',
            'content' => 'Test content',
        ]);

    $article = Article::query()->first();

    $response->assertRedirect(route('dashboard.articles.show', $article));
    expect($article->title)->toBe('Test Article');
    expect($article->content)->toBe('Test content');
});

it('validates required fields when storing', function () {
    $response = $this->actingAs($this->user)
        ->post(route('dashboard.articles.store'), []);

    $response->assertSessionHasErrors(['title', 'content']);
});

// Edit & Update

it('displays the edit form', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.edit', $article));

    $response->assertSuccessful();
    $response->assertSee($article->title);
});

it('displays the edit form for a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->actingAs($this->user)
        ->get(route('dashboard.articles.edit', $article));

    $response->assertSuccessful();
    $response->assertSee($article->title);
});

it('updates an article', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->put(route('dashboard.articles.update', $article), [
            'title' => 'Updated Title',
            'content' => 'Updated content',
        ]);

    $response->assertRedirect(route('dashboard.articles.show', $article));
    expect($article->fresh()->title)->toBe('Updated Title');
    expect($article->fresh()->content)->toBe('Updated content');
});

it('updates a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->actingAs($this->user)
        ->put(route('dashboard.articles.update', $article), [
            'title' => 'Updated Trashed Title',
            'content' => 'Updated trashed content',
        ]);

    $response->assertRedirect(route('dashboard.articles.show', $article));
    expect($article->fresh()->title)->toBe('Updated Trashed Title');
});

it('validates required fields when updating', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->put(route('dashboard.articles.update', $article), []);

    $response->assertSessionHasErrors(['title', 'content']);
});

// Destroy (soft delete)

it('soft deletes an article', function () {
    $article = Article::factory()->create();

    $response = $this->actingAs($this->user)
        ->delete(route('dashboard.articles.destroy', $article));

    $response->assertRedirect(route('dashboard.articles.index', ['filter' => 'trashed']));
    expect($article->fresh()->trashed())->toBeTrue();
});

// Restore

it('restores a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->actingAs($this->user)
        ->post(route('dashboard.articles.restore', $article));

    $response->assertRedirect(route('dashboard.articles.show', $article));
    expect($article->fresh()->trashed())->toBeFalse();
});

// Force Delete

it('permanently deletes a trashed article', function () {
    $article = Article::factory()->create();
    $article->delete();

    $response = $this->actingAs($this->user)
        ->delete(route('dashboard.articles.force-delete', $article));

    $response->assertRedirect(route('dashboard.articles.index', ['filter' => 'trashed']));
    expect(Article::withTrashed()->find($article->id))->toBeNull();
});
