@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-14">
        <a href="{{ route('articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">&larr; Back to articles</a>

        <h1 class="text-3xl font-bold mt-6">{{ $article->title }}</h1>
        <p class="text-sm text-gray-400 mt-2">{{ $article->created_at->format('M d, Y') }}</p>

        <div class="mt-8 text-gray-700 leading-relaxed whitespace-pre-line">{{ $article->content }}</div>
    </div>
@endsection
