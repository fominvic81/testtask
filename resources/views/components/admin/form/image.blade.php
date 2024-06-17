@props(['image', 'name'])

<label x-data="{ image: {{ empty($image) ? 'undefined' : '\''.\App\Helpers\ImageHelper::url($image).'\'' }}, name: {{ empty($image) ? 'undefined' : '\''.$image.'\'' }} }" class="w-full h-full border-2 border-dashed border-gray-400 relative flex items-center justify-center">
    <img class="max-w-full max-h-full" x-bind:src="image ?? '/images/add-image.png'" src="/images/add-image.png" alt="Зоображення" />
    <input
        type="file"
        accept="image/*"
        class="hidden"
        x-on:change="
            const data = new FormData(); data.append('image', $event.target.files?.item(0));
            axios.postForm('{{ route('images.store') }}', data).then((res) => ({ url: image, name } = res.data));"
    />
    <input type="hidden" name="{{ $name ?? 'image' }}" x-bind:value="name">
</label>