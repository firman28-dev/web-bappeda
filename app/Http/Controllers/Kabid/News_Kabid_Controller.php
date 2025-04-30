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

        $news = News::where('bidang_id', $user->bidang_id)
        ->orderBy('id','desc')
        ->get();

        $sent = [
            'news' => $news
        ];
        return view('kabid.news.index', $sent);
    }

    public function edit($id){
        $status = Status::whereIn('id', [4,5])->get();
        $news = News::find($id);
        $sent = [
            'status' => $status,
            'news' => $news
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
            return redirect()->route('k-news.index');

        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
