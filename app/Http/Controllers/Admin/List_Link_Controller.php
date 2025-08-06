<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ListLinkRequest;
use App\Models\List_Link;
use App\Models\Status;
use Illuminate\Http\Request;

class List_Link_Controller extends Controller
{
    public function index(){
        $list_link = List_Link::orderBy('id', 'desc')->get();
        $sent = [
            'list_link' => $list_link
        ];

        return view('admin.list_link.index', $sent);
    }

    public function create(){
        $status = Status::whereIn('id', [4, 5])->get();
        $sent = [
            'status' => $status
        ];
        return view('admin.list_link.create', $sent);

    }
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'status_id' => 'required',
            'description' => 'required|string'

        ],[
            'name.required' => 'Nama wajib diisi.',
            'status_id.required' => 'Status wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'url.required' => 'URL wajib diisi.',
            'path.required' => 'Foto wajib diunggah.',
            'path.image' => 'Foto yang diunggah harus berupa gambar.',
            'path.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'path.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $file = $request->path;
        
        try {
            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/list_link/', $fileName);
            }

            $list_link = new List_Link();
            $list_link->name = $request->name;
            $list_link->description = $request->description;
            $list_link->url = $request->url;
            $list_link->path = $fileName;
            $list_link->status_id = $request->status_id;
            $list_link->save();
            return redirect()->route('list-link.index')->with('success', 'Berhasil Menambahkan Data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $list_link = List_Link::find($id);
        $status = Status::whereIn('id', [4, 5])->get();

        $sent = [
            'list_link' => $list_link,
            'status' => $status
        ];
        if($list_link){
            return view('admin.list_link.edit', $sent);
        }
        else{
            return view('error_page.error_404');
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'name' => 'required|string|max:255',
            'url' => 'required|string|max:255',
            'description' => 'required|string',
            'path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
        ],[
            'name.required' => 'Nama wajib diisi.',
            'url.required' => 'URL wajib diisi.',
            'description.required' => 'Deskripsi wajib diisi.',
            'path.image' => 'Foto yang diunggah harus berupa gambar.',
            'path.mimes' => 'Foto harus berformat jpeg, png, jpg, atau gif.',
            'path.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $file = $request->path;
        
        try {
            

            $list_link = List_Link::find($id);
            $list_link->name = $request->name;
            $list_link->description = $request->description;
            $list_link->url = $request->url;
            if ($file) {
                $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/list_link/' . $list_link->path;
                if (file_exists($oldFile)) {
                    unlink($oldFile); 
                }
                $unique = uniqid();

                $fileName = $unique.'_'.time().'_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/list_link/', $fileName);
                $list_link->path = $fileName;
            }
            
            $list_link->status_id = $request->status_id;
            $list_link->save();
            return redirect()->route('list-link.index')->with('success', 'Berhasil Mengubah Data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $list_link = List_Link::findOrFail($id);
        if($list_link){
            $imagePath = public_path('uploads/list_link/' . $list_link->path);
            if (file_exists($imagePath)) {
                unlink($imagePath);
            }
            $list_link->delete();
        }
        return redirect()->back()->with('success', 'Berhasil Menghapus data');
    }
}
