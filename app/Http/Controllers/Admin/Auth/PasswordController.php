<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\Editor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    public function show()
    {
        return view('admin.auth.change-password');
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'old_password' => ['required', Password::defaults()],
            'new_password' => ['required', 'confirmed', Password::defaults()],
        ]);

        if (!Hash::check($data['old_password'], $request->user()->password)) {
            return back()->withInput()->withErrors([
                'old_password' => 'Старий пароль не правильний',
            ]);
        }

        $request->user()->update(['password' => Hash::make($data['new_password'])]);

        return redirect()->route('admin.home');
    }
}
