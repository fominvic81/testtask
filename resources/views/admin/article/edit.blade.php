<x-layouts.admin title="Редагувати новину">
    
    <form action="{{ route('articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="grid gap-1">
            @include('admin.article.inc.form')
            <x-admin.form.submit>Зберегти</x-admin.form.submit>
        </div>
    </form>

</x-layouts.admin>