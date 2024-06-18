<x-layouts.admin title="Змінити пароль">
    <form action="{{ route('changepassword') }}" method="POST">
        @method('PUT')
        @csrf
        <div class="grid gap-2">
            <x-admin.form.text autocomplete="old-password" type="password" name="old_password" label="Старий пароль"></x-admin.form.text>
            <x-admin.form.errors name="old_password"></x-admin.form.errors>
            <x-admin.form.text autocomplete="new-password" type="password" name="new_password" label="Новий пароль"></x-admin.form.text>
            <x-admin.form.errors name="new_password"></x-admin.form.errors>
            <x-admin.form.text autocomplete="new-password" type="password" name="new_password_confirmation" label="Підтвердіть новий пароль"></x-admin.form.text>
            <x-admin.form.errors name="new_password_confirmation"></x-admin.form.errors>
            <x-admin.form.submit>Змінити пароль</x-admin.form.submit>
        </div>
    </form>
</x-layouts.admin>