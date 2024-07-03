@extends('layouts.app')

@section('content')
    <section class="text-accent body-font">
        <div class="container mx-auto flex px-5 py-10 items-center justify-center flex-col">
            <img class="lg:w-2/6 md:w-3/6 w-5/6 mb-1 object-cover object-center rounded" alt="hero" src="{{ asset('images/hero.png') }}">
            <div class="lg:w-2/3 w-full mb-8 border-b-4 border-stone-400">
             　  <!--タイトル-->
                <h1 class="text-center title-font sm:text-4xl text-3xl mb-10 font-medium text-neutral">Start your journey to find your best pudding!</h1>

                <!--説明-->
                <div class="flex flex-wrap sm:-m-4 -mx-4 -mb-10 -mt-4 md:space-y-0 space-y-6">
                    <div class="p-4 md:w-1/3 flex">
                        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                            </svg>
                        </div>
                        <div class="flex-grow pl-6">
                            <h2 class="text-neutral text-lg title-font font-medium mb-2">記録する</h2>
                            <p class="leading-relaxed text-neutral">全国のカフェや喫茶店で出会った美味しいプリンを記録</p>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/3 flex">
                        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                            </svg>
                        </div>
                        <div class="flex-grow pl-6">
                            <h2 class="text-neutral text-lg title-font font-medium mb-2">見つける</h2>
                            <p class="leading-relaxed text-neutral">エリアやカテゴリーで絞り込んで他ユーザーの投稿からお店探し</p>
                        </div>
                    </div>
                    <div class="p-4 md:w-1/3 flex">
                        <div class="w-12 h-12 inline-flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500 mb-4 flex-shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12Z" />
                            </svg>
                        </div>
                        <div class="flex-grow pl-6">
                            <h2 class="text-neutral text-lg title-font font-medium mb-2">保存する</h2>
                            <p class="leading-relaxed text-neutral">気になるお店はお気に入りに保存して次回食べにいきましょう</p>
                        </div>
                    </div>
                </div>
                
                <!--ログインボタン-->
                <div class="flex justify-center py-8">
                    <a class="btn btn-neutral" href="{{ route('login') }}">
                        <div class="flex justify-center items-center px-4">
                            <div class="mr-1">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                                  <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                                </svg>
                            </div>
                            <div>ログインしてはじめる</div>
                        </div>
                    </a>
                </div>
            </div>
            
            <!--新着投稿-->
            <h2 class="text-center title-font sm:text-2xl text-xl mb-1 font-medium text-neutral">新着投稿</h1>
            <div class="mt-6">
                @if ($articles->isNotEmpty())
                    <div class="flex flex-wrap -m-4">
                        @foreach($articles->take(4) as $article)
                            @include('articles.partial.card')
                        @endforeach
                    </div>
                    <div class="mt-4">
                      <div class="text-neutral text-center">※ 各投稿の詳細閲覧にはログインが必要です</div>
                    </div>
                @else
                    <div class="text-lg text-gray-400">No contents</div>
                @endif
            </div>
            
            <!--ログインボタン-->
            <div class="flex justify-center py-8">
                <a class="btn btn-neutral" href="{{ route('login') }}">
                    <div class="flex justify-center items-center px-4">
                        <div class="mr-1">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15M12 9l3 3m0 0-3 3m3-3H2.25" />
                            </svg>
                        </div>
                        <div>ログインしてはじめる</div>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection
