@if (Auth::user()->is_favorite($article->id))
    {{-- お気に入り解除ボタンのフォーム --}}
    <form method="POST" action="{{ route('favorites.unfavorite', $article->id) }}">
        @csrf
        @method('DELETE')
        <button class="rounded-full w-10 h-10 p-0 border border-stone-400 inline-flex items-center justify-center text-red-400 ml-4 hover:text-stone-300">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
        </button>
    </form>
@else
    {{-- お気に入りボタンのフォーム --}}
    <form method="POST" action="{{ route('favorites.favorite', $article->id) }}">
        @csrf
        <button class="rounded-full w-10 h-10 p-0 border border-stone-400 inline-flex items-center justify-center text-stone-300 ml-4 hover:text-red-400">
            <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                <path d="M20.84 4.61a5.5 5.5 0 00-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 00-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 000-7.78z"></path>
            </svg>
        </button>
    </form>
@endif