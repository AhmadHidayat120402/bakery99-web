<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class loginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.pages.login');
    }

    protected function redirectTo()
    {
        switch (Auth::user()->role) {
            case 'peserta':
                return redirect()->route('peserta.menu');
            case 'admin':
                return redirect()->route('admin.dashboard');
        }
    }


    public function login(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'password' => 'required',
            ],
            [
                'name.required' => 'Masukkan name Anda.',
                'password.required' => 'Masukkan password Anda.',
            ]
        );

        if (Auth::attempt([
            'name' => $request->name,
            'password' => $request->password
        ])) {

            $request->session()->regenerate();

            Log::info('User logged in: ' . $request->name);
            Log::info('Redirecting to /admin');

            return redirect('/admin')->with('status', 'Login berhasil');
        }

        return back()->withErrors([
            'name' => 'Name atau password salah.',
        ])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
