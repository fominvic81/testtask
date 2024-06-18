<x-layouts.main :title="$article->title">
    <div class="flex flex-col items-center">
        <div class="w-full max-w-4xl">
            <div class="w-full p-4 mt-1 bg-gray-50">
                <div class="flex justify-end gap-3 text-lg">
                    @can('update', $article)
                        <a class="text-blue-600 hover:text-blue-400 hover:underline" href="{{ route('articles.edit', $article) }}">Редагувати</a>
                    @endcan
                    @can('delete', $article)
                        <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Ви впевнені що хочете видалити новину &quot;{{ $article->title }}&quot;?')">
                            @method('DELETE')
                            @csrf
                            <button class="text-blue-600 hover:text-red-400 hover:underline">Видалити</button>
                        </form>
                    @endcan
                </div>
                <div class="text-ellipsis whitespace-nowrap overflow-hidden flex gap-1">
                    <a class="block text-ellipsis overflow-hidden max-w-[50%] text-blue-500 hover:text-blue-400 hover:underline" href="{{ $prevUrl }}">{{ $prevTitle }}</a>
                    >
                    <div class="text-ellipsis overflow-hidden max-w-[50%]">{{ $article->title }}</div>
                </div>
                <h1 class="pl-2 text-3xl font-bold">{{ $article->title }}</h1>
                <div class="pl-2 text-gray-400 font-semibold">Дата: {{ $article->created_at->setTimezone(config('app.timezone_client'))->format('d.m.Y H:i') }}</div>
                <img class="bg-gray-200 w-full h-full max-h-[400px] my-3 object-contain" src="{{ \App\Helpers\ImageHelper::url($article->image) }}" alt="Зображення">
                <div class="text-lg whitespace-pre-line">{!! $text !!}</div>
            </div>
            <div class="w-full grid grid-cols-2 gap-4 my-3">
                <x-news.neighbour-card :article="$prev" title="Попередня новина"></x-news.neighbour-card>
                <x-news.neighbour-card :article="$next" title="Наступна новина"></x-news.neighbour-card>
            </div>
        </div>
    </div>
</x-layouts.main>