<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KritikSaran;
use Illuminate\Http\Request;

class KritikSaran_Controller extends Controller
{
    public function index()
    {
        $kritik = KritikSaran::orderBy('id', 'desc')->get();
        return view('admin.kritik_saran.index', compact('kritik'));
    }

    public function destroy($id){
        $kritik = KritikSaran::findOrFail($id);
        // return $page_system;
        if($kritik){
            $kritik->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
            
        }
    }

}
