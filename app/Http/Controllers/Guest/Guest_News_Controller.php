<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Bidang;
use App\Models\News;
use Illuminate\Http\Request;

class Guest_News_Controller extends Controller
{
    public function getAllCategory($id){
        $bidang = Bidang::find($id);
        $categoryNews = News::where('bidang_id',$id)->get();

        $sent = [
            'categoryNews' => $categoryNews,
            'bidang' => $bidang
        ];
        return view('guest.news.index', $sent);

        // return $categoryNews;
    }

    public function news($id){
        $news = News::find($id);
        $newsAll = News::where('bidang_id', $news->bidang_id)
        ->get();
        // return $news;
        $sent = [
            'news' => $news,
            'newsAll' => $newsAll
        ];

        return view('guest.news.show', $sent);

    }
}
