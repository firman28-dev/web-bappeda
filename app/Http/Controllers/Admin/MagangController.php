<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Magang;
use Illuminate\Http\Request;

class MagangController extends Controller
{
    
    public function index()
    {
        $magang = Magang::all();

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

   
    public function update(Request $request, $id)
    {
        //
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
