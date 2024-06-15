<div class="grid grid-cols-[1fr_150px] grid-rows-[150px] gap-2">
    <div>
        <x-admin.form.text label="Заголовок" name="title" value="{{ old('title') ?? $article->title ?? '' }}"></x-admin.form.text>
        <x-admin.form.tags label="Теги" name="tags" :value="old('tags') ?? (isset($article) ? $article->tags->map(fn ($tag) => $tag->name) : [])" :highlighted="session('collisions')"></x-admin.form.tags>
    </div>
    <x-admin.form.image name="image" image="{{ old('image') ?? $article->image ?? null }}"></x-admin.form.image>
</div>
<x-admin.form.textarea label="Текст" name="text" value="{{ old('text') ?? $article->text ?? '' }}"></x-admin.form.textarea>
<x-admin.form.checkbox label="Показувати в стрічці" name="is_active" checked="{{ old('is_active') ?? $article->is_active ?? true }}"></x-admin.form.checkbox>

<x-admin.form.errors></x-admin.form.errors>