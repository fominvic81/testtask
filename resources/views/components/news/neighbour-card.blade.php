@props(['article', 'title'])

@if ($article)
    <div>
        <a class="grid grid-cols-[auto_1fr] grid-rows-[auto_1fr] gap-1 h-24 p-1 bg-gray-50 hover:scale-[98%] hover:brightness-90 transition-all" href="{{ route('news.show', $article) }}">
            <div class="row-span-2 max-w-32 h-full max-h-full">
                <img class="w-full h-full object-contain" src="{{ \App\Helpers\ImageHelper::url($article->image) }}">
            </div>
            <div class="text-lg font-semibold whitespace-nowrap text-ellipsis overflow-hidden">{{ $article->title }}</div>
            <div class="text-gray-400 font-semibold">Дата: {{ $article->created_at->setTimezone(config('app.timezone_client'))->format('d.m.Y H:i') }}</div>
        </a>
        <div class="indent-2 font-bold">{{ $title }}</div>
    </div>
@else
    <div></div>
@endif