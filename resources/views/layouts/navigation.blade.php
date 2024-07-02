<div class="navbar bg-base-100">
    <div class="flex-1">
        <a class="btn btn-ghost text-xl" href="/">PUDDING</a>
    </div>
    @if (Auth::check())
        <div class="flex gap-2">
            <a class="btn btn-ghost" href="{{ route('articles.create') }}">新規投稿作成</a>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost">
                    マイリスト
                </div>
                <ul
                    tabindex="0"
                    class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow"
                >
                    <li><a href="{{ route('users.articles', Auth::id()) }}">自分の記事</a></li>
                    <li><a href="{{ route('users.favorites', Auth::id()) }}">お気に入り</a></li>
                </ul>
            </div>
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                    <div class="w-10 rounded-full">
                        <img src="{{ isset(Auth::user()->avatar) ? asset('storage/' . Auth::user()->avatar) : asset('images/default_user_image.png') }}" alt="">
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                @csrf
                    <ul
                      tabindex="0"
                      class="menu menu-sm dropdown-content bg-base-100 rounded-box z-[1] mt-3 w-52 p-2 shadow">
                        <li><a href="{{ route('profile.edit') }}">プロフィール編集</a></li>
                        <li><a href="#" onclick="event.preventDefault();this.closest('form').submit();">Logout</a></li>
                    </ul>
                </form>
            </div>
        @else
            <div class="flex gap-2">
                <ul class="menu menu-horizontal px-1">
                    <li><a href="{{ route('register') }}">新規ユーザー登録</a></li>
                    <li><a href="{{ route('login') }}">ログイン</a></li>
                </ul>
            </div>
        @endif
    </div>
</div>