@props(['article'])

<a href="{{ route('articles.show', $article) }}" class="block bg-white rounded-xl border border-gray-200 p-6 flex flex-col justify-between hover:shadow-md transition-shadow">
    <div>
        <h2 class="text-lg font-semibold leading-snug">{{ $article->title }}</h2>
        <p class="text-gray-600 text-sm mt-3 leading-relaxed">{{ Str::limit($article->content, 120) }}</p>
    </div>
    <p class="text-xs text-gray-400 mt-5">{{ $article->created_at->format('M d, Y') }}</p>
</a>
