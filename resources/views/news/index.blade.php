<x-layouts.layout title="Новини">
    
    <div class="grid grid-cols-1 lg:grid-cols-2 w-full max-w-5xl mx-auto gap-3">
        @foreach($articles as $article)
            <a class="grid grid-cols-[auto_1fr] grid-rows-2 gap-2 h-36 bg-gray-200 hover:brightness-95 rounded-lg shadow-lg" href="{{ route('news.show', $article) }}">
                <div class="row-span-2 max-w-44 max-h-36">
                    <img class="w-full h-full object-contain" src="{{ \App\Helpers\ImageHelper::url($article->image) }}"></img>
                </div>
                <div>
                    {{ $article->title }}
                </div>
                <div>
                    {{ $article->created_at }}
                </div>
            </a>
        @endforeach
    </div>

    {{ $articles->links() }}
</x-layouts.layout>