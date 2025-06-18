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
        return view('admin.sosial_media.edit', compact('sosmed'));
        
    }
}
