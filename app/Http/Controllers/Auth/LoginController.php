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

    // public function login(LoginRequest $request)
    // {
    //     $credentials = $request->getCredentials();

    //     if(!Auth::validate($credentials)):
    //         return redirect()->to('login')
    //             ->withErrors(trans('auth.failed'));
    //     endif;
    //     $user = Auth::getProvider()->retrieveByCredentials($credentials);
        
        

    //     Auth::login($user);
    //     return $this->authenticated($request, $user)->with('success', "Account successfully login.");
    // }
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('username', 'password');

        // Coba login
        if (Auth::attempt($credentials)) {
            // Auth berhasil, redirect ke dashboard (atau route tujuanmu)
            return redirect()->intended('/dashboard')->with('success', 'Login berhasil, selamat datang!');
            // return redirect()->intended('/dashboard'); // atau route('dashboard')
        }

        // Auth gagal
        return back()->withErrors([
            'username' => 'username atau password salah.',
        ])->withInput($request->except('password'));
        
    }                   

    protected function authenticated(Request $request, $user)
    {
        return redirect()->intended();
    }

    
}
