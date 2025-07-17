<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaduan;
use Illuminate\Http\Request;

class PengaduanController extends Controller
{
    public function index(){
        $pengaduan = Pengaduan::all();

        return view('admin.pengaduan.index', compact('pengaduan'));
    }

    public function destroy($id){
        $pengaduan = Pengaduan::findOrFail($id);
        // return $page_system;
        if($pengaduan){
            $pengaduan->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
            
        }
    }
}
