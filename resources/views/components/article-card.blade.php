@props(['article'])

@php
    $showUrl = auth()->check() ? route('dashboard.articles.show', $article) : route('articles.show', $article);
@endphp

<a href="{{ $showUrl }}"
    class="block bg-white rounded-xl border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
    <div>
        <div class="flex items-center gap-2">
            <h2 class="text-lg font-semibold leading-snug">{{ $article->title }}</h2>
            @if ($article->trashed())
                <span class="text-xs font-medium text-red-600 bg-red-50 px-2 py-0.5 rounded-full">Trashed</span>
            @endif
        </div>
        <p class="text-gray-600 text-sm mt-3 leading-relaxed">{{ Str::limit($article->content, 120) }}</p>
    </div>
    <p class="text-xs text-gray-400 mt-5">{{ $article->created_at->format('M d, Y') }}</p>
</a>
