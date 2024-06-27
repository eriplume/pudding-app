@extends('layouts.app')

@section('content')
    <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            @if (isset($articles))
                <div class="flex flex-wrap -m-4">
                  @foreach($articles as $article)
                          @include('articles.card')
                  @endforeach
                </div>
            @else
                <div>No contents</div>
            @endif
        </div>
    </section>
@endsection