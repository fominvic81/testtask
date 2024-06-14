@props(['name', 'label', 'value'])

<label class="flex flex-col indent-2">
    {{ $label }}
    <textarea class="p-2 rounded-md border border-gray-300 resize-y h-40" name="{{ $name }}" placeholder="{{ $label }}">{{ $value ?? '' }}</textarea>
</label>