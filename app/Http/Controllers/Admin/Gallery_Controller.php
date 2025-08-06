<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Status;
use Illuminate\Http\Request;

class Gallery_Controller extends Controller
{
    public function index(){
        $gallery = Gallery::orderBy('id','desc')->get();
        $status = Status::whereIn('id', [4, 5])->get();
        return view('admin.gallery.index', compact('gallery','status'));
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:3078',
            'status_id' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'image.required' => 'Foto wajib diunggah.',
            'image.image' => 'Foto yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        $file = $request->image;
        
        try {
            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                //untuk server
                // $path = $file->storeAs('uploads/list_link', $fileName, 'public');
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/gallery/', $fileName);
            }

            $banner = new Gallery();
            $banner->name = $request->name;
            $banner->image = $fileName;
            $banner->status_id = $request->status_id;
            $banner->save();
            return redirect()->route('gallery.index')->with('success', 'Berhasil Menambahkan data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3078',
            'status_id' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'image.image' => 'Foto yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran foto maksimal 3MB.',
        ]);

        $file = $request->image;
        
        try {
            
            $gallery = Gallery::find($id);
            // return $banner;
            $gallery->name = $request->name;
            if ($file) {
                $unique = uniqid();
                $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/gallery/' . $gallery->image;
                if (file_exists($oldFile)) {
                    unlink($oldFile); // Hapus file lama
                }
                $fileName = $unique.'_'.time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/gallery/', $fileName);
                $gallery->image = $fileName;
            }
            $gallery->status_id = $request->status_id;
            $gallery->save();
            return redirect()->route('gallery.index')->with('success', 'Berhasil Mengubah data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $gallery = Gallery::findOrFail($id);
        if ($gallery->image) {
            $imagePath = public_path('uploads/gallery/' . $gallery->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $gallery->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
