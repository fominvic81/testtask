<div class="grid grid-cols-[1fr_150px] grid-rows-[auto] gap-2">
    <div>
        <x-admin.form.text label="Заголовок" name="title" :value="old('title') ?? $article->title ?? ''"></x-admin.form.text>
        <x-admin.form.errors name="title"></x-admin.form.errors>

        <x-admin.form.tags label="Теги" name="tags" :value="old('tags') ?? (isset($article) ? $article->tags->map(fn ($tag) => $tag->name) : [])" :highlighted="session('collisions')"></x-admin.form.tags>

        <x-admin.form.errors name="collisions"></x-admin.form.errors>
        <div>
            @foreach ($errors->get('tags.*') as $tagErrors)
                @foreach ($tagErrors as $error)
                    <div class="text-red-500">{{ $error }}</div>                    
                @endforeach
            @endforeach
        </div>
    </div>
    <div class="h-36">
        <x-admin.form.image name="image" :image="old('image') ?? $article->image ?? null"></x-admin.form.image>
    </div>
</div>
<x-admin.form.textarea label="Текст" name="text" :value="old('text') ?? $article->text ?? ''"></x-admin.form.textarea>
<x-admin.form.errors name="text"></x-admin.form.errors>

<x-admin.form.checkbox label="Показувати в стрічці" name="is_active" :checked="old('is_active') ?? $article->is_active ?? true"></x-admin.form.checkbox>
<x-admin.form.errors name="is_active"></x-admin.form.errors>

<x-admin.form.errors name="image"></x-admin.form.errors>