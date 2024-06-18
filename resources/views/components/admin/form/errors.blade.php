@props(['name'])

<div>
    @foreach ((empty($name) ? $errors->all() : $errors->get($name)) as $error)
        <div class="text-red-500">{{ $error }}</div>
    @endforeach
</div>