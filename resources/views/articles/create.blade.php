@extends('layouts.app')

@section('content')
    <div class="max-w-3xl mx-auto px-4 py-14">
        <a href="{{ route('articles.index') }}" class="text-sm text-gray-500 hover:text-gray-700 transition-colors">&larr; Back to articles</a>

        <h1 class="text-3xl font-bold mt-6 mb-8">New Article</h1>

        <form method="POST" action="{{ route('articles.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}" required autofocus
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">
                @error('title')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-medium text-gray-700 mb-1">Content</label>
                <textarea name="content" id="content" rows="10" required
                    class="w-full rounded-lg border border-gray-300 px-3 py-2 text-sm focus:border-gray-900 focus:ring-1 focus:ring-gray-900 outline-none">{{ old('content') }}</textarea>
                @error('content')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition-colors">
                Publish Article
            </button>
        </form>
    </div>
@endsection
