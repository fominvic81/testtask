<x-layouts.layout title="Вхід">
    <div class="size-full flex items-center flex-col">
        <form class="mt-[15%]" action="{{ route('login') }}" method="POST">
            @csrf
            <div class="flex items-center flex-col w-[280px] px-10 py-5 gap-2 bg-gray-200 rounded-md border border-gray-300 font-semibold">
            <h1 class="text-2xl font-bold">Вхід</h1>

                <label class="flex flex-col indent-2 w-full">
                    Email
                    <input class="p-1 border border-gray-300 rounded-md" name="email" type="email" placeholder="Email" :value="old('email')">
                </label>
                <label class="flex flex-col indent-2 w-full">
                    Пароль
                    <input class="p-1 border border-gray-300 rounded-md" autocomplete="old-password" name="password" type="password" placeholder="Пароль">
                </label>
    
                @foreach ($errors->all() as $error)
                    <div class="text-red-500 text-sm">{{ $error}}</div>
                @endforeach
                <button class="w-full bg-gray-50 p-1 rounded-md border border-gray-300 hover:brightness-[85%]" type="submit">Ввійти</button>
            </div>
        </form>
    </div>
</x-layouts.layout>