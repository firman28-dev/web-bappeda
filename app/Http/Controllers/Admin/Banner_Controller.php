<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class Banner_Controller extends Controller
{
    public function index(){
        $banner = Banner::orderBy('id','desc')->get();
        $status = Status::whereIn('id', [4, 5])->get();

        $sent = [
            'banner' => $banner,
            'status' => $status
        ];

        return view('admin.banner.index', $sent);
        
    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status_id' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'image.required' => 'Foto wajib diunggah.',
            'image.image' => 'Foto yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $file = $request->image;
        
        try {
            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                //untuk server
                // $path = $file->storeAs('uploads/list_link', $fileName, 'public');
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/banner/', $fileName);
            }

            $banner = new Banner();
            $banner->name = $request->name;
            $banner->image = $fileName;
            $banner->status_id = $request->status_id;
            $banner->save();
            return redirect()->route('banner.index')->with('success', 'Berhasil Menambahkan data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'status_id' => 'required'
        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'image.image' => 'Foto yang diunggah harus berupa gambar.',
            'image.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'image.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $file = $request->image;
        
        try {
            
            $banner = Banner::find($id);
            // return $banner;
            $banner->name = $request->name;
            if ($file) {
                $unique = uniqid();
                $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/banner/' . $banner->image;
                if (file_exists($oldFile)) {
                    unlink($oldFile); // Hapus file lama
                }
                $fileName = $unique.'_'.time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/banner/', $fileName);
                $banner->image = $fileName;
            }
            $banner->status_id = $request->status_id;
            $banner->save();
            return redirect()->route('banner.index')->with('success', 'Berhasil Mengubah data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function create(){
        $status = Status::whereIn('id', [4, 5])->get();
        $sent = [
            'status' => $status
        ];
        return view('admin.banner.create', $sent);

    }

    public function edit($id){
        $banner = Banner::find($id);
        $status = Status::whereIn('id', [4, 5])->get();

        $sent = [
            'banner' => $banner,
            'status' => $status
        ];
        if($banner){
            return view('admin.banner.edit', $sent);
        }
        else{
            return view('error_page.error_404');
        }

    }

    public function destroy($id){
        $banner = Banner::findOrFail($id);
        if ($banner->image) {
            $imagePath = public_path('uploads/banner/' . $banner->image);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
        }
    
        $banner->delete();
        return redirect()->back()->with('success', 'Berhasil menghapus data');
    }
}
