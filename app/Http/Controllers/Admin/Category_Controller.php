<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Category_Controller extends Controller
{
   
    public function index()
    {
        $category = Category::orderBy('id', 'desc')->get();
        return view('admin.category.index', compact('category'));
    }

    public function create()
    {
        $status = Status::whereIn('id', [1, 2])->get();
        $sent = [
            'status' => $status
        ];
        return view('admin.category.create', $sent);
    }

   
    public function store(Request $request){
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'status_id' => 'required',
        ],[
            'title.required' => 'Title wajib diisi.',
            'title.string' => 'Title harus berupa teks.',
            'title.max' => 'Title maksimal 255 karakter.',
            'title.min' => 'Title minimal 3 karakter.',
            'status_id.required' => 'Status wajib diisi.',
        ]);
        
        $user = Auth::user();

        try {
            
            $category = new Category();
            $category->title = $request->title;
            $category->status_id = $request->status_id;
            $category->created_by = $user->id;
            $category->updated_by = $user->id;

            $category->save();
            return redirect()->route('category.index')->with('success', 'Berhasil Menambahkan Data');

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
        $category = Category::find($id);
        $status = Status::whereIn('id', [1, 2])->get();

        $sent = [
            'category' => $category,
            'status' => $status
        ];
        
        if($category){
            return view('admin.category.edit', $sent);
        }
        else{
            return view('error_page.error_404');
        }
        
    }

    
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255|min:3',
            'status_id' => 'required',
        ],[
            'title.required' => 'Title wajib diisi.',
            'title.string' => 'Title harus berupa teks.',
            'title.max' => 'Title maksimal 255 karakter.',
            'title.min' => 'Title minimal 3 karakter.',
            'status_id.required' => 'Status wajib diisi.',
        ]);
        
        $user = Auth::user();

        try {
            
            $category = Category::find($id);
            $category->title = $request->title;
            $category->status_id = $request->status_id;
            $category->updated_by = $user->id;

            $category->save();
            return redirect()->route('category.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        if($category){
            $category->delete();
        }
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }
}
