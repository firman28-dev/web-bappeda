<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\News;
use App\Models\Status;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

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
        $sent = [
            'bidang' => $bidang,
            'status' => $status
        ];
        return view('admin.news.create', $sent);
    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'bidang_id' => 'required',
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
            if ($file) {
                $fileName = time(). '_' . $file->getClientOriginalName();
                //untuk server
                // $path = $file->storeAs('uploads/list_link', $fileName, 'public');
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/news/', $fileName);
                $news->image = $fileName;
            }
            $news->save();
            Alert::success('Success!', 'Berhasil Menambahkan Data');
            return redirect()->route('news.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function edit($id){
        $bidang = Bidang::where('status_id',1)->get();
        $status = Status::whereIn('id', [4,5])->get();
        $news = News::find($id);
        $sent = [
            'bidang' => $bidang,
            'status' => $status,
            'news' => $news
        ];
        return view('admin.news.edit', $sent);
    }

    public function update(Request $request, $id){
        $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'bidang_id' => 'required',
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
            Alert::success('Success!', 'Berhasil Mengubah Data');
            return redirect()->route('news.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $news = News::findOrFail($id);
        if($news){
            $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. 'uploads/news/' .$news->image;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        $news->delete();
        Alert::success('Success!', 'Berhasil Menghapus Data');
        return redirect()->back();
    }

   
}
