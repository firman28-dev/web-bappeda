<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\PegawaiBappeda;
use Illuminate\Http\Request;

class PegawaiBappedaController extends Controller
{
    public function index(){
        $pegawai = PegawaiBappeda::orderBy('id', 'asc')
            ->where('status','A')
            ->get();
        $bidang = Bidang::all();
        $sent = [
            'pegawai' => $pegawai,
            'bidang' => $bidang
        ];
        return view('admin.pegawai_bappeda.index', $sent);
    }

    public function update(Request $request, $id){
        $request->validate([
            'nama_pns' => 'required|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3078',
            'bidang' => 'nullable'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'path.image' => 'Foto yang diunggah harus berupa gambar.',
            'path.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'path.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        $file = $request->path;
        
        try {
            
            $pegawai = PegawaiBappeda::find($id);
            // return $banner;
            $pegawai->nama_pns = $request->nama_pns;
            if ($file) {
                $unique = uniqid();
                $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/pegawai_bappeda/' . $gapegawaillery->path;
                if (file_exists($oldFile)) {
                    unlink($oldFile); 
                }
                $fileName = $unique.'_'.time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/pegawai_bappeda/', $fileName);
                $pegawai->path = $fileName;
            }
            $pegawai->bidang = $request->bidang;
            $pegawai->save();
            return redirect()->route('pegawai-bappeda.index')->with('success', 'Berhasil Mengubah data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
