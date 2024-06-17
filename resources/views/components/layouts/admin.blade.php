@props(['title'])

<x-layouts.layout title="{{ $title }}">
    <div class="size-full grid grid-cols-[250px_1fr]">
        <div class="bg-gray-300">
            <div class="bg-gray-700 text-gray-200">
                <a class="block w-full text-center text-3xl font-bold py-1" href="{{ route('home') }}">Новини</a>
                <div class="w-full text-center text-xl p-1">{{ Auth::user()->lastname.' '.Auth::user()->firstname }}</div>
            </div>
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('admin.home') }}">Головна</a>
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('editors.edit', Auth::user()) }}">Редагувати профіль</a>
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('articles.create')}}">Створити новину</a>
            @can('create', \App\Models\Editor\Editor::class)
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('editors.create') }}">Створити Редактора</a>
            @endcan
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('articles.my') }}">Мої новини</a>
            @can('view-any', \App\Models\Article\Article::class)
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('articles.index') }}">Всі новини</a>
            @endcan
            @can('view-any', \App\Models\Editor\Editor::class)
            <a class="block w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all" href="{{ route('editors.index') }}">Редактори</a>
            @endcan
            <form class="block bg-inherit" action="{{ route('logout' )}}" method="POST">
                @csrf
                <button class="w-full indent-2 py-2 bg-inherit hover:brightness-105 transition-all text-left">Вийти</button>
            </form>
        </div>
        <div class="bg-gray-200 p-3 overflow-hidden">
            <h1 class="text-3xl">{{ $title }}</h1>
            {{ $slot }}
        </div>
    </div>
</x-layouts.layout>