@extends('layouts.app')

@section('content')
    <div class="mt-4">
        {{-- タブ --}}
        @include('users.tabs')
        <div class="mt-16">
            {{-- ユーザー一覧 --}}
            @include('articles.partial.articles')
        </div>
    </div>
@endsection