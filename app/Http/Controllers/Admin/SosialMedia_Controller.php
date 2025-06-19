<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SosialMedia;
use Illuminate\Http\Request;

class SosialMedia_Controller extends Controller
{
    public function index(){
        $sosmed = SosialMedia::all();
        return view('admin.sosial_media.index', compact('sosmed'));
    }

    public function create(){
        return view('admin.sosial_media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'platform' => 'required|string',
            'embed_code' => 'required|string',
        ]);

        SosialMedia::create([
            'platform' => $request->platform,
            'embed_code' => $request->embed_code,
        ]);
        return redirect()->route('sosial-media.index')->with('success', 'Berhasil Menambahkan Data');
    }
 

    public function edit($id){
        $sosmed = SosialMedia::find($id);
        if($sosmed){
            return view('admin.sosial_media.edit', compact('sosmed'));
        }
        else{
            return view('error_page.error_404');
        }
        
    }

   public function update(Request $request, $id)
    {
        $request->validate([
            'platform' => 'required|string|max:255',
            'embed_code' => 'required|string',
        ]);

        try {
            // Cari data berdasarkan ID
            $sosialMedia = SosialMedia::findOrFail($id);

            // Update data
            $sosialMedia->update([
                'platform' => $request->platform,
                'embed_code' => $request->embed_code,
            ]);

            return redirect()->route('sosial-media.index')->with('success', 'Berhasil Memperbarui Data');
        } catch (\Exception $e) {
            // Log error (opsional)
            \Log::error('Gagal update Sosial Media: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui data');
        }
    }

}
