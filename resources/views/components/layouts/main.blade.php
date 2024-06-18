@props(['title'])

<x-layouts.layout :title="$title">
    <div class="flex flex-col min-h-full">
        <div class="grid grid-cols-[1fr_auto_1fr] items-center w-full bg-gray-100 py-2">
            <div></div>
            <a class="text-4xl font-bold text-gray-600" href="{{ route('home') }}">Новини</a>
            <div class="flex justify-end items-stretch h-full">
                @auth
                    <a class="mr-10 flex items-center text-blue-500 hover:text-blue-400 hover:underline" href="{{ route('admin.home') }}">Адмін панель</a>
                @endauth
            </div>
        </div>
        <div class="bg-gray-300 grow">
            {{ $slot }}
        </div>
    </div>
</x-layouts.layout>