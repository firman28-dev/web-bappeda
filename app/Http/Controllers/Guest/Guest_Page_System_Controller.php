<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Page_System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class Guest_Page_System_Controller extends Controller
{
    public function show($id){
        $page_system = Page_System::find($id);
        if($page_system){
            $news = News::orderBy('created_at', 'desc')->take(3)->get();
            $breaking_news = News::orderBy('id', 'desc')->first();

            $sent =[
                'page_system' => $page_system,
                'news' => $news,
                'breaking_news' => $breaking_news
            ];
            return view('guest.page_system.index', $sent);
        }
        else{
            return view('guest.error_page.error_404');
        }
        
    }

    public function showPpid($id){
        $kategoriMapping = [
            1 => 'Informasi Serta Merta',
            2 => 'Informasi Setiap Saat',
            3 => 'Informasi Secara Berkala',
            6 => 'Informasi Dikecualikan',
        ];

        $news = News::orderBy('created_at', 'desc')->take(3)->get();
        $breaking_news = News::orderBy('id', 'desc')->first();
    
        $nama_kategori = $kategoriMapping[$id] ?? '';
        $url = "https://ppid.sumbarprov.go.id/api/cluster-data?id_instansi=62&id_category={$id}";
    
        try {
            $response = Http::timeout(10)->get($url);
            $data = $response->successful() ? $response->json() : [];
        } catch (\Exception $e) {
            \Log::error('API PPID error: ' . $e->getMessage());
            $data = [];
        }
    
        return view('guest.ppid.index', compact('data', 'nama_kategori','news', 'breaking_news'));
    }
    
}
