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
use Illuminate\Support\Facades\Cache;

class Home_Controller extends Controller
{
    public function index(){
        $list_link = Cache::remember('list_link', 30, function () {
            return List_Link::where('status_id', 4)->get(['path','url','id']);
        });
        $bidang = Bidang::where('status_id', 1)
            ->with(['_news:id,title,description,bidang_id,image,created_at,hits,created_by,hits']) 
            ->get(['id', 'icon', 'label']);
            // ->with('_news')
            // ->get();
        $latest_news = News::where('status_id',4)
            ->orderBy('created_at', 'desc')
            ->first();
       
        $news_sumbar = News::where('category_id', 8)
            ->where('status_id', 4)
            ->orderBy('id','desc')->limit(10)
            ->get();
        
        $banner = Cache::remember('banner', 30, function () {
            return Banner::where('status_id', 4)->orderBy('id', 'desc')->get(['id', 'image', 'name']);
        });
        $faqs = Cache::remember('faq', 30, function () {
            return FAQ::where('status_id', 1)->get(['id', 'name', 'description']);
        });
        
        // $list_link = List_Link::where('status_id',4)->get();
       
        // $bidang = Bidang::where('status_id', 1)->with('_news')->get();
        // $latest_news = News::orderBy('created_at', 'desc')
        //     ->limit(1)
        //     ->get();
        // $news_sumbar = News::where('category_id', 8)->orderBy('id','desc')->limit(10)->get();

        // $banner = Banner::where('status_id',4)
        // ->orderBy('id', 'desc')
        // ->get();

        // $faqs =FAQ::where('status_id',1)->get();

        $sent = [
            'list_link' => $list_link,
            'bidang' => $bidang,
            'latest_news' => $latest_news,
            'banner' => $banner,
            'news_sumbar' => $news_sumbar,
            'faqs' => $faqs

        ];

        return view('guest.home.index',$sent );
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
