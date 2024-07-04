<div class="mt-6">
    @if ($articles->isNotEmpty())
        <div class="flex flex-wrap -m-4">
          @foreach($articles as $article)
                  @include('articles.partial.card')
          @endforeach
        </div>
        
        <div class="my-6">
            {{ $articles->links() }}
        </div>
    @else
        <div class="text-lg text-neutral">No contents</div>
    @endif
</div>