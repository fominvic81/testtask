@props(['label', 'name', 'checked'])

<label class="flex gap-1 items-center">
    <input type="checkbox" name="{{ $name }}" value="1" @checked($checked ?? false)>
    <span>{{ $label }}</span>
</label>