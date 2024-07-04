@extends('layouts.app')

@section('content')
    <p class="mt-8">
        <a class="link link-hover text-neutral" href="/"><< 記事一覧へ戻る</a>
    </p>
    <section class="text-gray-600 body-font overflow-hidden">
        <div class="container px-5 py-16 mx-auto">
            
            <div class="lg:w-4/5 mx-auto flex flex-col border rounded-lg bg-white px-8 pb-8 pt-10">
                <!--image-->
                <div class="lg:max-w-lg lg:w-full lg:ml-10 mb-10 md:mb-0 p-2 border">
                    <img class="w-full object-cover object-center rounded" alt="hero" src="{{ Storage::url($article->image) }}" width="720" height="600">
                </div>
                <div class="w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                    <!--タイプ-->
                    <div class="badge badge-accent badge-outline badge-lg mb-2">{{ $article->typeName }}</div>
                    <div class="flex">
                    <!--タイトル-->
                        <h1 class="text-gray-900 text-3xl title-font font-medium mb-1">{{ $article->title }}</h1>
                        @include('articles.partial.favorite_button')
                    </div>
                    <div class="flex mb-4">
                        <!--都道府県-->
                        <span class="flex items-center">
                            <div class="flex leading-relaxed sm:text-lg text-md mb-1 items-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1 text-stone-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1 1 15 0Z" />
                                </svg>
                                <span>{{ $article->prefName }}</span>
                            </div>
                        </span>
                        <span class="flex ml-3 pl-3 py-2 border-l border-stone-300 space-x-2s">
                            <!--店名-->
                            <div class="flex leading-relaxed sm:text-lg text-md mb-1 items-center mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 mr-1 text-stone-400">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 21v-7.5a.75.75 0 0 1 .75-.75h3a.75.75 0 0 1 .75.75V21m-4.5 0H2.36m11.14 0H18m0 0h3.64m-1.39 0V9.349M3.75 21V9.349m0 0a3.001 3.001 0 0 0 3.75-.615A2.993 2.993 0 0 0 9.75 9.75c.896 0 1.7-.393 2.25-1.016a2.993 2.993 0 0 0 2.25 1.016c.896 0 1.7-.393 2.25-1.015a3.001 3.001 0 0 0 3.75.614m-16.5 0a3.004 3.004 0 0 1-.621-4.72l1.189-1.19A1.5 1.5 0 0 1 5.378 3h13.243a1.5 1.5 0 0 1 1.06.44l1.19 1.189a3 3 0 0 1-.621 4.72M6.75 18h3.75a.75.75 0 0 0 .75-.75V13.5a.75.75 0 0 0-.75-.75H6.75a.75.75 0 0 0-.75.75v3.75c0 .414.336.75.75.75Z" />
                                </svg>
                                <span>{{ $article->shop }}</span>
                            </div>
                        </span>
                    </div>
            
                    <!--地図-->
                    @if($article->address)
                        <div class="mb-8">
                            <div id="map" style="height:300px; width:80%;"></div>
                        </div>
                    @endif
                    
                    <!--本文-->
                    @if($article->content)
                        <p class="leading-relaxed">{{ $article->content }}</p>
                    @endif
                    
                    <div class="flex mt-6 items-center pb-5 border-b border-neutral mb-5"></div>
                    
                    <div class="flex">
                        <div class="flex items-center text-xl text-gray-900">
                            <div class="w-10 rounded-full">
                                <img src="{{ isset($article->user->avatar) ? asset('storage/' . $article->user->avatar) : asset('images/default_user_image.png') }}" alt="">
                            </div>
                            <div class="ml-1 text-neutral">{{ $article->user->name }}</div>
                        </div>
                        
                        <!--編集・削除ボタン-->
                        @if (Auth::id() == $article->user_id)
                            <form method="GET" action="{{ route('articles.edit', $article->id) }}" class="ml-auto">
                                @csrf
                                <button class="flex text-white bg-neutral border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded">
                                    <div class="flex items-center">
                                        <div>Edit</div>
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-1">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                        </svg>
                                    </div>
                                </button>
                            </form>
                            
                            <form method="POST" action="{{ route('articles.destroy', $article->id) }}" class="ml-1">
                                @csrf
                                @method('DELETE')
                                    <button 
                                        class="flex ml-1 text-white bg-primary border-0 py-2 px-6 focus:outline-none hover:bg-yellow-600 rounded"
                                        onclick="return confirm('削除しますか？')"
                                    >
                                        <div class="flex items-center">
                                            <div>Delete</div>
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 ml-1">
                                              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </div>
                                    </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
         
    <script>
        var prefName = @json($article->prefName);
        var addressDetail = @json($article->address);
    </script>
    <script src="{{ asset('/js/map.js') }}"></script>
    <script
        src="https://maps.googleapis.com/maps/api/js?language=ja&region=JP&key={{ config('app.google_maps_api_key') }}&callback=initMap"
        async
        defer>
    </script>
@endsection('content')