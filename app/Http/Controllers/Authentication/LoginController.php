<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.form-login');
    }

    public function register()
    {
        return view('auth.form-register');
    }

    public function doLogin(LoginRequest $request)
    {
        if (auth()->attempt($request->validated())) {

            $request->session()->regenerate();

            if (auth()->user()->access_user_id === 1) {
                // jika user administrator
                return redirect()->intended('/dashboard');
            } else if (auth()->user()->access_user_id === 2) {
                // jika user user
                return redirect()->intended('/home');
            } else {
                // jika user user
                return redirect()->intended('/home');
            }
        }

        // jika email atau password salah
        // kirimkan session error
        // Alert::warning('Perhatian!', 'Email atau password salah');
        return redirect('login')->with(['danger' => 'Email dan password salah!']);
    }

    public function registerProses(RegisterRequest $request)
    {
        User::create([
            'name'              => $request->name,
            'email'             => $request->validated('email'),
            'password'          => Hash::make($request->validated('password')),
        ]);

        return redirect('login')->with(['success' => 'Registrasi berhasil.']);
    }

    public function logout(Request $request)
    {
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
