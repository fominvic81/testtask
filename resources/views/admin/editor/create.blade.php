<x-layouts.admin title="Створити редактора">
    
    <form action="{{ route('editors.store') }}" method="POST">
        @csrf
        <div class="grid gap-1">
            <x-admin.form.text label="Ім'я" name="firstname" value="{{ old('firstname') }}"></x-admin.form.text>
            <x-admin.form.text label="Прізвище" name="lastname" value="{{ old('lastname') }}"></x-admin.form.text>
            <x-admin.form.text label="Email" name="email" type="email" value="{{ old('email') }}"></x-admin.form.text>
            <x-admin.form.text label="Пароль" name="password" type="password"></x-admin.form.text>
            <x-admin.form.text label="Підтвердження пароля" name="password_confirmation" type="password"></x-admin.form.text>
    
            <x-admin.form.errors></x-admin.form.errors>
            <x-admin.form.submit>Створити</x-admin.form.submit>
        </div>
    </form>

</x-layouts.admin>