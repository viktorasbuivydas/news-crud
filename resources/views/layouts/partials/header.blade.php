<header class="bg-white border-b border-gray-200">
    <div class="max-w-6xl mx-auto px-4 py-5 flex items-center justify-between">
        <a href="{{ route('articles.index') }}" class="text-xl font-bold tracking-tight">News</a>
        <div class="flex items-center gap-4">
            @auth
                <a href="{{ route('articles.create') }}"
                    class="rounded-lg bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700 transition-colors">
                    New Article
                </a>
            @endauth
            @auth
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-300 transition-colors">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}"
                    class="rounded-lg bg-gray-200 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-300 transition-colors">
                    Login
                </a>
                <a href="{{ route('register') }}"
                    class="rounded-lg bg-gray-100 px-4 py-2 text-sm font-medium text-gray-900 hover:bg-gray-200 transition-colors">
                    Register
                </a>
            @endauth
        </div>
    </div>
</header>
