<x-layouts.main :title="$article->title">
    <div class="flex flex-col items-center">
        <div class="w-full max-w-4xl">
            <div class="w-full p-4 mt-1 bg-gray-50">
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
                <x-news.neighbour-card :article="$prev"></x-news.neighbour-card>
                <x-news.neighbour-card :article="$next"></x-news.neighbour-card>
            </div>
        </div>
    </div>
</x-layouts.main>