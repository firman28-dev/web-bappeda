<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Group;
use App\Models\Pejabat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Pejabat_Controller extends Controller
{
    
    public function index()
    {
        $pejabat = Pejabat::all();
        return view('admin.pejabat.index', compact('pejabat'));
    }

   
    public function create()
    {
        $bidang = Bidang::all();
        $group = Group::whereIn('id', [1, 2,5])->get();

        $sent = [
            'bidang' => $bidang,
            'group' => $group
        ];
        return view('admin.pejabat.create', $sent);

    }

   
    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required|string|max:255',
            'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'bidang_id' => 'nullable',
            'group_id' => 'required',
        ],);
        $user = Auth::user();

        $file = $request->path;
        try {

            $pejabat = new Pejabat();
            $pejabat->name = $request->name;
            $pejabat->bidang_id = $request->bidang_id;
            $pejabat->group_id = $request->group_id;
            $pejabat->created_by = $user->id;
            $pejabat->updated_by = $user->id;

            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/pejabat/', $fileName);
                $pejabat->path = $fileName;
            }
            $pejabat->save();
            return redirect()->route('pejabat.index')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

  
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $bidang = Bidang::all();
        $group = Group::whereIn('id', [1, 2,5])->get();
        $pejabat = Pejabat::find($id);

        

        $sent = [
            'bidang' => $bidang,
            'group' => $group,
            'pejabat' => $pejabat
        ];
        if($pejabat){
            return view('admin.pejabat.edit', $sent);
        }
        else{
            return view('error_page.error_404');
        }
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // 'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'path' => 'required',
            'bidang_id' => 'nullable',
            'group_id' => 'required',
        ],);
        $user = Auth::user();

        $file = $request->path;
        try {
            $pejabat = Pejabat::find($id);
            $pejabat->name = $request->name;
            $pejabat->bidang_id = $request->bidang_id;
            $pejabat->group_id = $request->group_id;
            $pejabat->updated_by = $user->id;

            if ($file) {
                $unique = uniqid();
                if (!empty($page_system->image)) {
                    $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/pejabat/' . $pejabat->path;
                    if (file_exists($oldFile) && is_writable($oldFile)) {
                        unlink($oldFile); // Hapus file lama
                    }
                }
                $fileName = $unique.'_'.time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/pejabat/', $fileName);
                $pejabat->path = $fileName;
            }

            $pejabat->save();
            return redirect()->route('pejabat.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id)
    {
        
    }
}
