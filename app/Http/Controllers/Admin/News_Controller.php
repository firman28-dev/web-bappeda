<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\Category;
use App\Models\News;
use App\Models\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Str;

class News_Controller extends Controller
{
    public function index(){
        $news = News::orderBy('id', 'desc')->get();
        $sent = [
            'news' => $news
        ];
        return view('admin.news.index', $sent);
    }

    public function create(){
        $bidang = Bidang::where('status_id',1)->get();
        $status = Status::whereIn('id', [4,5])->get();
        $category = Category::where('status_id', 1)->get();

        $sent = [
            'bidang' => $bidang,
            'status' => $status,
            'category'=>$category
        ];
        return view('admin.news.create', $sent);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'bidang_id' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required',
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
            return redirect()->route('news.index')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $bidang = Bidang::where('status_id',1)->get();
        $category = Category::where('status_id',1)->get();
        $status = Status::whereIn('id', [4,5])->get();
        $news = News::find($id);
        $sent = [
            'bidang' => $bidang,
            'status' => $status,
            'news' => $news,
            'category' =>$category
        ];
        return view('admin.news.edit', $sent);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'bidang_id' => 'required',
            'category_id' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status_id' => 'required',
        ],);
        // dd($request->description);
        $file = $request->image;


        try {

            $news = News::find($id);
            $news->title = $request->title;
            $news->description = $request->description;
            $news->bidang_id = $request->bidang_id;
            $news->status_id = $request->status_id;
            $news->category_id = $request->category_id;


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
            return redirect()->route('news.index')->with('success', 'Berhasil Mengubah Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $news = News::findOrFail($id);
        if($news->image){
            $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. '/uploads/news/' .$news->image;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }

        // if($news){
        //     $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. 'uploads/news/' .$news->image;
        //     if (file_exists($oldPhotoPath)) {
        //         unlink($oldPhotoPath);
        //     }
        // }
        $news->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        // Alert::success('Success!', 'Berhasil Menghapus Data');
        // return redirect()->back();
    }

    public function uploadImage(Request $request){
        if ($request->hasFile('file')) {

            $file = $request->file('file');
            $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $destination = $_SERVER['DOCUMENT_ROOT'] .  '/uploads/news/konten';
            // $destination = public_path('uploads/news/konten');
            $file->move($destination, $filename);

            $url = asset('uploads/news/konten/' . $filename);
            return response()->json(['location' => $url]);

            // $path = $file->store('images2', 'public');
    
            // Hasilkan URL publik yang benar seperti /storage/images2/namafile.png
            // return response()->json(['location' => Storage::url($path)]);
        }
    
        return response()->json(['error' => 'No file uploaded'], 400);
    }

    public function uploadPDF(Request $request)
    {
        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $originalName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
            $originalName = Str::slug($originalName); // hasil: "surat-pernyataan-non-pkp"
            $extension = $file->getClientOriginalExtension();

            $filename = $originalName . '_' . Str::random(8) . '.' . $extension;

            // $filename = Str::random(20) . '.' . $file->getClientOriginalExtension();
            $destination = $_SERVER['DOCUMENT_ROOT'] .  '/uploads/news/konten_dokumen';
            $file->move($destination, $filename);
            $url = asset('/uploads/news/konten_dokumen/' . $filename);
            return response()->json(['location' => $url]);
        }

        return response()->json(['error' => 'No file uploaded'], 400);
    }

   
}
