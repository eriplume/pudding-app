<div class="tabs tabs-lifted">
    {{-- 記事一覧タブ --}}
    <a href="{{ route('users.articles', $user->id) }}" class="tab grow {{ Request::routeIs('users.articles') ? 'tab-active' : '' }} [--tab-bg:amber-50]">
        my articles
        <div class="badge badge-accent ml-1">{{ $user->articles_count }}</div>
    </a>
    {{-- お気に入り一覧タブ --}}
    <a href="{{ route('users.favorites', $user->id) }}" class="tab grow {{ Request::routeIs('users.favorites') ? 'tab-active' : '' }} [--tab-bg:amber-50]">
        Favorites
        <div class="badge badge-accent ml-1">{{ $user->favorites_count }}</div>
    </a>
</div>