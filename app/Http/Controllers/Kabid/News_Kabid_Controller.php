<?php

namespace App\Http\Controllers\Kabid;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\News;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class News_Kabid_Controller extends Controller
{
    public function index(){
        $user = Auth::user();
        $bidang = Bidang::where('id',$user->bidang_id)->first();

        $news = News::where('bidang_id', $user->bidang_id)
        ->orderBy('id','desc')
        ->get();

        $sent = [
            'news' => $news,
            'bidang' => $bidang
        ];
        return view('kabid.news.index', $sent);
    }

    public function edit($id){
        $user = Auth::user();
        $status = Status::whereIn('id', [4,5,6])->get();
        $bidang = Bidang::where('id',$user->bidang_id)->first();
        $news = News::find($id);
        $sent = [
            'status' => $status,
            'news' => $news,
            'bidang' =>$bidang
        ];
        return view('kabid.news.edit', $sent);
    }

    public function update(Request $request, $id){
        $request->validate([
            'status_id' => 'required',
        ],);

        try {

            $news = News::find($id);
            $news->status_id = $request->status_id;
            $news->save();
            return redirect()->route('k-news.index')->with('success', 'Berhasil Mengubah Data');


        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $news = News::findOrFail($id);
        if($news){
             if($news->image){
                $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. '/uploads/news/' .$news->image;
                if (file_exists($oldPhotoPath)) {
                    unlink($oldPhotoPath);
                }
            }
        
            $news->delete();
            return redirect()->back()->with('success', 'Berhasil Menghapus Data');
        }
        else{
            return redirect()->back()->with('error', 'Gagal Menghapus Data');
        }
       
    }
}
