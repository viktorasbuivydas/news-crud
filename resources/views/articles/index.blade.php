@extends('layouts.app')

@section('content')
    <div class="max-w-6xl mx-auto px-4 py-14">
        <h1 class="text-3xl font-bold mb-10">Latest Articles</h1>

        @if ($articles->isEmpty())
            <p class="text-gray-400">No articles yet.</p>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($articles as $article)
                    <x-article-card :article="$article" />
                @endforeach
            </div>

            <div class="mt-8">
                {{ $articles->links() }}
            </div>
        @endif
    </div>
@endsection
