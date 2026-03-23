@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-14">
        <a href="{{ route('articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">&larr;
            Back to articles</a>

        <h1 class="text-3xl font-bold mt-6">{{ $article->title }}</h1>

        @auth
            <div class="flex items-center gap-3 mt-4">
                <a href="{{ route('dashboard.articles.edit', $article) }}"
                    class="inline-flex items-center gap-1.5 rounded-lg border border-gray-300 px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50 transition-colors">
                    <x-lucide-pencil name="pencil" class="h-4 w-4" />
                    Edit
                </a>
                @if ($article->trashed())
                    <form action="{{ route('dashboard.articles.restore', $article) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-green-300 px-3 py-1.5 text-sm font-medium text-green-700 hover:bg-green-50 transition-colors">
                            <x-lucide-archive-restore class="h-4 w-4" />
                            Restore
                        </button>
                    </form>
                    <form action="{{ route('dashboard.articles.force-delete', $article) }}" method="POST"
                        onsubmit="return confirm('Are you sure? This will permanently delete the article.');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                            <x-lucide-trash-2 class="h-4 w-4" />
                            Delete Permanently
                        </button>
                    </form>
                @else
                    <form action="{{ route('dashboard.articles.destroy', $article) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this article?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="inline-flex items-center gap-1.5 rounded-lg border border-red-200 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 transition-colors">
                            <x-lucide-trash class="h-4 w-4" />
                            Delete
                        </button>
                    </form>
                @endif
            </div>
        @endauth
        <p class="text-sm text-gray-400 mt-2">{{ $article->created_at->format('M d, Y') }}</p>

        <div class="mt-8 text-gray-700 leading-relaxed whitespace-pre-line">{{ $article->content }}</div>
    </div>
@endsection
