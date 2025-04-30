<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;
use Session;

class LogoutController extends Controller
{
    public function perform()
    {
        $user = Auth::user();

        
        if ($user) {
            $user->session = null; // Hapus token
            $user->save(); // Simpan perubahan
        }

        Session::flush();
    
        Auth::logout();
        return redirect('/');
    }
}