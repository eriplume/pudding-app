@extends('layouts.app')

@section('content')
    <div class="py-16 mx-auto">
        {{-- タブ --}}
        @include('users.tabs')
        <div class="mt-16">
            {{-- 記事一覧 --}}
            @include('articles.partial.articles')
        </div>
        
        <p class="mt-8">
            <a class="link link-hover text-neutral" href="/"><< 全ての記事一覧へ</a>
        </p>
    </div>
@endsection