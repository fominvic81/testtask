<x-layouts.admin title="Редактори">
    <table class="w-full max-w-full border-2 border-gray-400 whitespace-nowrap table-fixed my-2">
        <tr class="bg-gray-300 text-left">
            <th class="text-left">Прізвище</th>
            <th class="text-left">Ім'я</th>
            <th class="text-left">Email</th>
            <th class="text-left">Чи адміністратор</th>
            <th class="text-left">Редагувати</th>
            <th class="text-left">Видалити</th>
        </tr>
        @foreach ($users as $user)
            <tr class="even:bg-gray-50 odd:bg-gray-200 hover:brightness-90 border-t-2 border-gray-400">
                <td>{{ $user->lastname }}</td>
                <td>{{ $user->firstname }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->is_admin ? 'Так' : 'Ні' }}</td>
                <td><a class="text-blue-600 hover:text-blue-400 hover:underline" href="{{ route('editors.edit', $user) }}">Редагувати</a></td>
                <td>
                    @can('delete', $user)
                        <form action="{{ route('editors.destroy', $user) }}" method="POST" onsubmit="return prompt('Ви впевнені що хочете видалити користувача {{ $user->lastname.' '.$user->firstname }} та всі статті створені ним? Введіть &quot;Видалити&quot; щоб підтвертити')?.toLowerCase() === 'видалити'">
                            @method('DELETE')
                            @csrf
                            <button class="text-blue-600 hover:text-red-400 hover:underline">Видалити</button>
                        </form>
                    @endcan
                </td>
            </tr>
            @endforeach
    </table>
</x-layouts.admin>