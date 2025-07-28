<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiTerbaik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PegawaiTerbaikController extends Controller
{
    public function index(){
        $session_date = Session::get('tahun_terpilih');
        // return $session_date;
        $pegawai = PegawaiTerbaik::where('tahun', $session_date)
            ->orderBy('bulan')
            ->get();
        return view('admin.pegawai_terbaik.index', compact('pegawai'));
    }

    public function create(){
        $session_date = Session::get('tahun_terpilih');
        return $session_date;

    }

}
