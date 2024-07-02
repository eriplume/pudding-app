<div class="mt-6">
    @if ($articles->isNotEmpty())
        <div class="flex flex-wrap -m-4">
          @foreach($articles as $article)
                  @include('articles.partial.card')
          @endforeach
        </div>
    @else
        <div class="text-lg text-gray-400">No contents</div>
    @endif
</div>