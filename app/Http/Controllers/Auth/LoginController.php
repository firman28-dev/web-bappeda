<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;


class LoginController extends Controller
{
    public function show()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil, selamat datang!');
        }

        return back()->withErrors([
            'username' => 'username atau password salah.',
        ])->withInput($request->except('password'));
        
    }                   

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    
}
