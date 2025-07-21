<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PermohonanInformasi;
use Illuminate\Http\Request;

class PermohonanInformasiController extends Controller
{
    public function index(){
        $permohonan = PermohonanInformasi::all();
        return view('admin.permohonan_informasi.index', compact('permohonan'));
    }

    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);

        $permohonan = PermohonanInformasi::findOrFail($id);
        $permohonan->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Berhasil Verifikasi Data');
    }

    public function destroy($id){
        $permohonan = PermohonanInformasi::findOrFail($id);
        // return $page_system;
        if($permohonan){
            $permohonan->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
            
        }
    }   
}
