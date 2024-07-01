@extends('layouts.app')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-16 mx-auto">
           
            <!--検索フォーム -->
            <form action="{{ route('articles.index') }}" method="GET">
                <div class="grid grid-cols-6">
                    <div class="col-span-1 mr-2">
                        <select name="type_id" class="select select-bordered w-full max-w-xs">
                            <option value="" {{ request('type_id') == '' ? "selected" : "" }}>全てのタイプ</option>
                            @foreach(config('pudding_types') as $type_id => $name)
                                <option value="{{ $type_id }}" {{ request('type_id') == $type_id ? "selected" : "" }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
                
                    <div class="col-span-1 mr-2">
                        <select name="pref_id" class="select select-bordered w-full max-w-xs">
                            <option value="" {{ request('pref_id') == '' ? "selected" : "" }}>全てのエリア</option>
                            @foreach(config('pref') as $pref_id => $name)
                                <option value="{{ $pref_id }}" {{ request('pref_id') == $pref_id ? "selected" : "" }}>{{ $name }}</option>
                            @endforeach
                        </select>
                    </div>
        
                    <div class="col-span-1 mr-3">
                        <input type="text" name="shop" class="input input-bordered w-full" value="{{ request('shop') }}" placeholder="shop名">
                    </div>
                    
                    <button type="submit" class="btn col-span-1">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                          <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                      serch
                    </button>
                </div>
            </form>
            
            <!--記事一覧エリア-->
            <div class="mt-6">
                @if ($articles->isNotEmpty())
                    <div class="flex flex-wrap -m-4">
                      @foreach($articles as $article)
                              @include('articles.card')
                      @endforeach
                    </div>
                @else
                    <div class="text-lg text-gray-400">No contents</div>
                @endif
            </div>
        </div>
    </section>
@endsection