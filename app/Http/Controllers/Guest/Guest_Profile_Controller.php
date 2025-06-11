<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Pejabat;
use Illuminate\Http\Request;

class Guest_Profile_Controller extends Controller
{
    public function index(){
        $pejabat = Pejabat::all();
        $sent = [
            'pejabat' => $pejabat
        ];
        return view('guest.profile.index', $sent);
    }
}
