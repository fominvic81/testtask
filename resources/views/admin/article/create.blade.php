<x-layouts.admin title="Створити новину">
    
    <form action="{{ route('articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid gap-1">
            @include('admin.article.inc.form')
            <x-admin.form.submit>Створити</x-admin.form.submit>
        </div>
    </form>

</x-layouts.admin>