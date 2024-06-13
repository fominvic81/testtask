<x-layouts.admin title="Редактори">
    <table class="w-full border-2 border-gray-400">
        <tr class="odd:bg-gray-300">
            <th class="text-left">Фамілія</th>
            <th class="text-left">Ім'я</th>
            <th class="text-left">Email</th>
            <th class="text-left">Чи адміністратор</th>
            <th class="text-left">Редагувати</th>
            <th class="text-left">Видалити</th>
        </tr>
        @foreach ($users as $user)
            <tr class="even:bg-gray-400 odd:bg-gray-300 hover:brightness-90">
                <td class="py-1">{{ $user->lastname }}</td>
                <td class="py-1">{{ $user->firstname }}</td>
                <td class="py-1">{{ $user->email }}</td>
                <td class="py-1">{{ $user->is_admin ? 'Так' : 'Ні' }}</td>
                <td class="py-1"><a class="underline text-blue-600 hover:text-blue-400" href="{{ route('editors.edit', $user) }}">Редагувати</a></td>
                <td class="py-1">
                    <form action="{{ route('editors.destroy', $user) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="underline text-blue-600 hover:text-blue-400">Видалити</button>
                    </form>
                </td>
            </tr>
            @endforeach
    </table>
</x-layouts.admin>