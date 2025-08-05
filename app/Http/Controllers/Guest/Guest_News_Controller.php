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
        if($bidang){
            $categoryNews = News::where('bidang_id', $id)
                ->orderBy('id', 'desc')
                ->paginate(9);
            $allBidang = Bidang::all();
            if (request('page') > $categoryNews->lastPage()) {
                return redirect()->route('guest.get-category', ['id' => $id, 'page' => $categoryNews->lastPage()]);
            }
            $sent = [
                'categoryNews' => $categoryNews,
                'bidang' => $bidang,
                'allBidang' => $allBidang,
                'currentCategoryId' => $id
            ];
            return view('guest.news.index', $sent);
        }
        else{
            return view('guest.error_page.error_404');
            // return view('error.index');
        }
        // return $categoryNews;
    }

    public function news($id){
        $news = News::find($id);
        if($news){
            $news->increment('hits');
            $newsAll = News::orderBy('id', 'desc')->get();
            // return $news;
            $sent = [
                'news' => $news,
                'newsAll' => $newsAll
            ];

            return view('guest.news.show', $sent);
        }
        else{
            return view('guest.error_page.error_404');
            // return view('error.index');
        }

    }
}
