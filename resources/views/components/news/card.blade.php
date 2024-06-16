<a class="grid grid-cols-[auto_1fr] grid-rows-[auto_1fr] gap-2 min-h-24 p-1 bg-gray-50 shadow hover:scale-[99%] hover:brightness-90 transition-all" href="{{ route('news.show', $article) }}">
    <div class="row-span-2 max-w-32 h-full max-h-24">
        <img class="w-full h-full object-contain" src="{{ \App\Helpers\ImageHelper::url($article->image) }}" alt="Попередня новина">
    </div>
    <div class="text-lg font-semibold">{{ $article->title }}</div>
    <div class="text-gray-400 font-semibold">Дата: {{ $article->created_at->setTimezone(config('app.timezone_client'))->format('d.m.Y H:i') }}</div>
</a>