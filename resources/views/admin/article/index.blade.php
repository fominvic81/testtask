<x-layouts.admin title="{{ $title }}">
    <table class="w-full max-w-full border-2 border-gray-400 whitespace-nowrap table-fixed my-2">
        <tr class="bg-gray-300 text-left">
            @if ($showAuthor)
            <th>Автор</th>
            @endif
            <th>Заголовок</th>
            <th>Дата</th>
            <th>Теги</th>
            <th>Показувати</th>
            <th>Редагувати</th>
            <th>Видалити</th>
        </tr>
        @foreach ($articles as $article)
            <tr class="even:bg-gray-50 odd:bg-gray-200 hover:brightness-90 border-t-2 border-gray-400">
                @if ($showAuthor)
                <td class="text-ellipsis overflow-hidden"><a class="underline text-blue-600 hover:text-blue-400" href="{{ route('editors.edit', $article->editor) }}">{{ $article->editor->lastname.' '.$article->editor->firstname }}</a></td>
                @endif
                <td class="text-ellipsis overflow-hidden">{{ $article->title }}</td>
                <td>{{ $article->created_at->setTimezone(config('app.timezone_client'))->format('d.m.Y H:i') }}</td>
                <td class="text-ellipsis overflow-hidden">{{ $article->tags->map(fn ($tag) => $tag->name)->join(', ') }}</td>
                <td>{{ $article->is_active ? 'Так' : 'Ні' }}</td>
                <td><a class="text-blue-600 hover:text-blue-400 hover:underline" href="{{ route('articles.edit', $article) }}">Редагувати</a></td>
                <td>
                    <form action="{{ route('articles.destroy', $article) }}" method="POST" onsubmit="return confirm('Ви впевнені що хочете видалити новину &quot;{{ $article->title }}&quot;')">
                        @method('DELETE')
                        @csrf
                        <button class="text-blue-600 hover:text-red-400 hover:underline">Видалити</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {{ $articles->links() }}
</x-layouts.admin>