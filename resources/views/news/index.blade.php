<x-layouts.main title="Новини">
    
    <div class="flex flex-col items-center">
        @if ($articles->count())
            <div class="grid gap-3 w-full max-w-5xl my-2">
                @foreach($articles as $article)
                    <x-news.card :article="$article"></x-news.card>
                @endforeach
                {{ $articles->links() }}
            </div>
        @else
            <div class="text-3xl font-bold mt-5">Новин ще немає</div>
        @endif
    </div>

</x-layouts.main>