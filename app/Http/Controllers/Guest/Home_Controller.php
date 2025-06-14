<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bidang;
use App\Models\FAQ;
use App\Models\List_Link;
use App\Models\Menu_Public;
use App\Models\News;
use Http;
use Illuminate\Http\Request;

class Home_Controller extends Controller
{
    public function index(){
        $list_link = List_Link::where('status_id',4)->get();
       
        $bidang = Bidang::where('status_id', 1)->with('_news')->get();
        $latest_news = News::orderBy('created_at', 'desc')
            ->limit(1)
            ->get();
        $news_sumbar = News::where('category_id', 8)->orderBy('id','desc')->limit(10)->get();

        $banner = Banner::where('status_id',4)
        ->orderBy('id', 'desc')
        ->get();

        $faqs =FAQ::where('status_id',1)->get();

        $sent = [
            'list_link' => $list_link,
            // 'menu_public' => $menu_public,
            'bidang' => $bidang,
            'news' => $latest_news,
            'banner' => $banner,
            'news_sumbar' => $news_sumbar,
            'faqs' => $faqs

        ];

        return view('guest.home.index', $sent);
    }

    public function detailRealisasi(){
        // try {
        //     $url = "https://admin-dashboard.sumbarprov.go.id/api/simbangda/getrealisasikegiatanopd/72/2024";
        //     $response = Http::get($url);
        //     if ($response->successful()) {
        //         $data = $response->json(); 
        //         return $data['result'];
        //         return view('guest.home.detail_realisasi', ['data' => $data]);
                
        //     } else {
        //         return view('guest.home.detail_realisasi', ['data' => null]);
               
        //     }
        // } catch (\Exception $e) {
        //     return view('guest.home.detail_realisasi', ['data' => null, 'error' => $e->getMessage()]);
           
        // }
        return view('guest.home.detail_realisasi');

    }
}
