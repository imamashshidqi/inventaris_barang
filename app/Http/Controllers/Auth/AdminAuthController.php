<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class AdminAuthController extends Controller
{
    /**
     * Menampilkan form login untuk admin.
     */
    public function showLoginForm()
    {
        // Mengarahkan ke view yang akan kita buat
        return view('auth.admin-login');
    }

    /**
     * Memproses percobaan login admin.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Menambahkan kondisi 'is_admin' => true saat otentikasi
        if (Auth::attempt([...$credentials, 'is_admin' => true])) {
            $request->session()->regenerate();
            // Redirect ke dashboard admin setelah berhasil login
            return redirect()->intended('/dashboard'); // Ganti dengan route dashboard admin Anda
        }

        return back()->withErrors([
            'email' => 'Email atau Password salah, atau Anda bukan admin.',
        ])->onlyInput('email');
    }

    /**
     * Menampilkan form registrasi untuk admin.
     */
    public function showRegistrationForm()
    {
        // Mengarahkan ke view yang akan kita buat
        return view('auth.admin-register');
    }

    /**
     * Memproses registrasi admin baru.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => true, // <-- PENTING: Set user baru sebagai admin
        ]);

        Auth::login($user);

        return redirect('/dashboard'); // Ganti dengan route dashboard admin Anda
    }
}
