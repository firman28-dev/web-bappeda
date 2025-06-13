<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FAQ;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FAQ_Controller extends Controller
{
    public function index()
    {
        $faq = FAQ::orderBy('id', 'desc')->get();
        return view('admin.faq.index', compact('faq'));
    }

    public function create()
    {
        $status = Status::whereIn('id', [1, 2])->get();
        return view('admin.faq.create', compact('status'));
        
    }

   
    public function store(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required',
        ],);

        $user = Auth::user();

        try {

            $faq = new FAQ();
            $faq->name = $request->name;
            $faq->description = $request->description;
            $faq->status_id = $request->status_id;
            $faq->created_by = $user->id;
            $faq->updated_by = $user->id;

            $faq->save();
            return redirect()->route('faq.index')->with('success', 'Berhasil Menambahkan Data');

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
        $status = Status::whereIn('id', [1, 2])->get();
        $faq= FAQ::find($id);
        return view('admin.faq.edit', compact('status','faq'));
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'status_id' => 'required',
        ],);

        $user = Auth::user();

        try {

            $faq = FAQ::find($id);
            $faq->name = $request->name;
            $faq->description = $request->description;
            $faq->status_id = $request->status_id;
            $faq->updated_by = $user->id;

            $faq->save();
            return redirect()->route('faq.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }   
    }

    
    public function destroy($id)
    {
        
    }
}
