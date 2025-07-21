<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    
    public function index()
    {
        $magang = Magang::orderBy('id', 'desc')->get();

        return view('admin.magang.index', compact('magang'));
    }

   
    public function create()
    {
        //
    }

    
    public function store(Request $request)
    {
        //
    }

   
    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        //
    }

   
    public function update(Request $request, $id){
        $request->validate([
            'status' => 'required'
        ]);

        $magang = Magang::findOrFail($id);
        $magang->update([
            'status' => $request->status,
        ]);
        return redirect()->back()->with('success', 'Berhasil Verifikasi Data');
    }

    
    public function destroy($id){
        $magang = Magang::findOrFail($id);
        // return $page_system;
        if($magang){
            $magang->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
            
        }
    }
}
