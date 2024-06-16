<x-layouts.main title="Новини">
    
    <div class="flex flex-col items-center">
        <div class="grid gap-3 w-full max-w-5xl my-2">
            @foreach($articles as $article)
                <x-news.card :article="$article"></x-news.card>
            @endforeach
            {{ $articles->links() }}
        </div>
    </div>

</x-layouts.main>