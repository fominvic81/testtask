@props(['title'])

<x-layouts.layout :title="$title">
    <div class="flex flex-col min-h-full">
        <div class="text-center w-full bg-gray-100 text-4xl font-bold text-gray-600 py-2">
            <a href="{{ route('home') }}">Новини</a>
        </div>
        <div class="bg-gray-300 grow">
            {{ $slot }}
        </div>
    </div>
</x-layouts.layout>