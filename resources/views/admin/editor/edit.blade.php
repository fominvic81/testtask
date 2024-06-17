<x-layouts.admin title="Редагувати профіль">
    <form action="{{ route('editors.update', $user) }}" method="POST">
        @method('PUT')
        @csrf
        <div class="grid gap-1">
            <x-admin.form.text label="Ім'я" name="firstname" value="{{ old('firstname') ?? $user->firstname }}"></x-admin.form.text>
            <x-admin.form.text label="Прізвище" name="lastname" value="{{ old('lastname') ?? $user->lastname }}"></x-admin.form.text>
            <x-admin.form.text label="Email" name="email" type="email" value="{{ old('email') ?? $user->email }}"></x-admin.form.text>
    
            <x-admin.form.errors></x-admin.form.errors>
            <x-admin.form.submit>Зберегти</x-admin.form.submit>
        </div>
    </form>
</x-layouts.admin>