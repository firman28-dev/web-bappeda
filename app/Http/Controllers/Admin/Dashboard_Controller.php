<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Pengaduan;
use App\Models\User;
use Illuminate\Http\Request;

class Dashboard_Controller extends Controller
{
    public function index(){
        $user = User::select('id')->count();
        $bidang = Bidang::select('id')->count();
        $pengaduan = Pengaduan::select('id')->count();


        $sent = [
            'user' => $user,
            'bidang' => $bidang,
            'pengaduan' => $pengaduan
        ];

        return view('dashboard.index',$sent);
    }
}
