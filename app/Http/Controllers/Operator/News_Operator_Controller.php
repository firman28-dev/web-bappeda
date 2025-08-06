<?php

namespace App\Http\Controllers\Operator;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\News;
use App\Models\Status;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class News_Operator_Controller extends Controller
{
    public function index(){
        $user = Auth::user();

        $news = News::where('bidang_id', $user->bidang_id)
        ->orderBy('id','desc')
        ->get();

        $sent = [
            'news' => $news,
            'user' =>$user
        ];
        return view('operator.news.index', $sent);
    }

    public function create(){
        $user = Auth::user();

        $bidang = Bidang::where('id',$user->bidang_id)->first();
        $status = Status::where('id', 6)->first();
        $category = Category::where('status_id', 1)->get();

        $sent = [
            'bidang' => $bidang,
            'status' => $status,
            'category' => $category
        ];
        return view('operator.news.create', $sent);
    }

    public function store(Request $request){
        $user = Auth::user();

        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'bidang_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required',
            'category_id' => 'required',

        ],);

        $file = $request->image;
        // return $request->description;

        try {

            $news = new News();
            $news->title = $request->title;
            $news->description = $request->description;
            $news->bidang_id = $request->bidang_id;
            $news->status_id = $request->status_id;
            $news->category_id = $request->category_id;
            $news->created_by = $user->id;
            $news->updated_by = $user->id;
            $news->hits = 0;

            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();

                //untuk server
                // $path = $file->storeAs('uploads/list_link', $fileName, 'public');
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/news/', $fileName);
                $news->image = $fileName;
            }
            $news->save();
            return redirect()->route('op-news.index')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $user = Auth::user();
        $bidang = Bidang::where('id',$user->bidang_id)->first();

        $category = Category::where('status_id',1)->get();
        $status = Status::where('id', 6)->first();

        $news = News::find($id);

        $sent = [
            'bidang' => $bidang,
            'news' => $news,
            'category' =>$category,
            'status' => $status
        ];
        return view('operator.news.edit', $sent);
    }

    public function update(Request $request, $id){
        $user = Auth::user();

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required',
        ],);

        $file = $request->image;
        // return $request->description;

        try {

            $news = News::find($id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->category_id = $request->category_id;
            $news->updated_by = $user->id;

            if ($file) {
                if (!empty($news->image)) {
                    $oldFile = $_SERVER['DOCUMENT_ROOT'] . '/uploads/news/' . $news->image;
            
                    // Pastikan file lama ada sebelum menghapus
                    if (file_exists($oldFile) && is_writable($oldFile)) {
                        unlink($oldFile); // Hapus file lama
                    }
                }
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT'] . '/uploads/news/', $fileName);
                $news->image = $fileName;
            }

            $news->save();
            return redirect()->route('op-news.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function uploadImage(Request $request){
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $path = $file->store('images2', 'public');
    
            // Hasilkan URL publik yang benar seperti /storage/images2/namafile.png
            return response()->json(['location' => Storage::url($path)]);
        }
    
        return response()->json(['error' => 'No file uploaded'], 400);
    }
}
