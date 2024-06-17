@props(['name', 'label', 'type', 'value', 'autocomplete'])

<label class="flex flex-col indent-2">
    {{ $label }}
    <input
        class="p-2 rounded-md border border-gray-300"
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        placeholder="{{ $label }}"
        value="{{ $value ?? '' }}"
        autocomplete="{{ $autocomplete ?? '' }}">
</label>