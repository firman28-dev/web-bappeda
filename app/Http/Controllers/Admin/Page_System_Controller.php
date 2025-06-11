<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page_System;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class Page_System_Controller extends Controller
{
    public function index(){
        $page_system = Page_System::orderBy('id','desc')->get();
        
        $sent = [
            'page_system' => $page_system
        ];

        return view('admin.page_system.index', $sent);

    }

    public function create(){
        $status = Status::whereIn('id', [4,5])->get();
        $sent = [
            'status' => $status
        ];
        return view('admin.page_system.create', $sent);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required',
        ],);

        $file = $request->image;

        // return $request->description;
        try {

            $page_system = new Page_System();
            $page_system->title = $request->title;
            $page_system->description = $request->description;
            $page_system->status_id = $request->status_id;
            if ($file) {
                $unique = uniqid();

                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                //untuk server
                // $path = $file->storeAs('uploads/list_link', $fileName, 'public');
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/page_system/', $fileName);
                $page_system->image = $fileName;
            }
            $page_system->save();
            // Alert::success('Success!', 'Berhasil Menambahkan Data');
            return redirect()->route('page-system.index')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $status = Status::whereIn('id', [4,5])->get();
        $page_system = Page_System::find($id);
        $page_system->description = str_replace(
            'src="../../storage/images/', 
            'src="' . asset('storage/images/'). '/', 
            $page_system->description
        );
        // dd($page_system->description);
        // return $page_system->description;   
        $sent = [   
            'status' => $status,
            'page_system' => $page_system
        ];
        return view('admin.page_system.edit', $sent);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required',
        ],);
        // dd($request->description);
        $file = $request->image;


        try {

            $page_system = Page_System::find($id);
            $page_system->title = $request->title;
            $page_system->description = $request->description;
            $page_system->status_id = $request->status_id;

            if ($file) {
                $unique = uniqid();
                if (!empty($page_system->image)) {
                    $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/page_sytem/' . $page_system->image;
            
                    if (file_exists($oldFile) && is_writable($oldFile)) {
                        unlink($oldFile); // Hapus file lama
                    }
                }
                $fileName = $unique.'_'.time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/page_sytem/', $fileName);
                $page_system->image = $fileName;
            }
            $page_system->save();
            return redirect()->route('page-system.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $page_system = Page_System::findOrFail($id);
        // return $page_system;
        if($page_system->image){
            $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. '/uploads/page_system/' .$page_system->image;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        $page_system->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }


    public function uploadImage(Request $request){
        if ($request->hasFile('file')) {

             $request->validate([
                'file' => 'required|image|mimes:jpg,jpeg,png,gif,webp|max:5120',
            ]);

            $file = $request->file('file');
            $filename = Str::random(20) . '_'.$file->getClientOriginalName();
            $destination = $_SERVER['DOCUMENT_ROOT'] .  '/uploads/page_system/konten';
            $file->move($destination, $filename);

            $url = asset('uploads/page_system/konten/' . $filename);
            return response()->json(['location' => (string)$url]);

        }
    
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
