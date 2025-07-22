<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Bidang;
use App\Models\FAQ;
use App\Models\IndikatorMakroSurvey;
use App\Models\List_Link;
use App\Models\Magang;
use App\Models\Menu_Public;
use App\Models\News;
use App\Models\Pengaduan;
use App\Models\PermohonanInformasi;
use App\Models\SosialMedia;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Home_Controller extends Controller
{
    public function indexPengaduan(){
        $pengaduan = Pengaduan::orderBy('id', 'desc')->get();
        $total1 = Pengaduan::where('status', 1)->count();
        $total2 = Pengaduan::where('status', 2)->count();
        $total3 = Pengaduan::where('status', 3)->count();
        $sent = [
            'pengaduan' => $pengaduan,
            'total1' => $total1,
            'total2' => $total2,
            'total3' => $total3
        ];
        return view('guest.pengaduan.index', $sent);
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'instansi' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required|string|min:10',
            'captcha_pengaduan' => 'required|numeric',
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        $expected = (int)$request->a + (int)$request->b;

        if ((int)$request->captcha_pengaduan !== $expected) {
            return back()->withErrors(['captcha_pengaduan' => 'Jawaban captcha salah.'])->withInput();
        }

       
        // Simpan pengaduan ke database
        Pengaduan::create([
            'name' => $request->name,
            'email' => $request->email,
            'instansi' => $request->instansi,
            'title' => $request->title,
            'description' => $request->description,
            'status' => 1,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return back()->with('success', 'Pengaduan berhasil dikirim.');
    }

    public function storeMagang(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'universitas' => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'tujuan' => 'required|string',
            'phone' => 'required|max:15',
            'email' => 'required|max:30',
            'started_at' => 'required',
            'ended_at' => 'required',
            'captcha_magang' => 'required|numeric',
            'a' => 'required|numeric',
            'b' => 'required|numeric',
            'path' => 'required|mimes:pdf|max:2048',
        ]);

        // return $request->started_at;

        $expected = (int)$request->a + (int)$request->b;

        if ((int)$request->captcha_magang !== $expected) {
            return back()->withErrors(['captcha_magang' => 'Jawaban captcha salah.'])->withInput();
        }

        $file = $request->file('path'); 
        $unique = uniqid();
        $fileName = $unique. '_' . $file->getClientOriginalName();
        $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/magang/', $fileName);

        // Simpan pengaduan ke database
        Magang::create([
            'name' => $request->name,
            'universitas' => $request->universitas,
            'jurusan' => $request->jurusan,
            'tujuan' => $request->tujuan,
            'phone' => $request->phone,
            'email' => $request->email,
            'path' => $fileName,
            'status' => 1,
            'start' => $request->started_at,
            'end' => $request->ended_at,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return back()->with('success', 'Pengajuan magang berhasil dikirim.');
    }

    public function storePermohonanInformasi(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|max:30',
            'instansi' => 'required|string|max:255',
            'phone' => 'required|max:15',
            'tujuan' => 'required|string',
            'path' => 'required|mimes:pdf|max:2048',
            'captcha_permohonan' => 'required|numeric',
            'a' => 'required|numeric',
            'b' => 'required|numeric',
        ]);

        $expected = (int)$request->a + (int)$request->b;

        if ((int)$request->captcha_permohonan !== $expected) {
            return back()->withErrors(['captcha_permohonan' => 'Jawaban captcha salah.'])->withInput();
        }

        $file = $request->file('path'); 
        $unique = uniqid();
        $fileName = $unique. '_' . $file->getClientOriginalName();
        $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/permohonan_informasi/', $fileName);

        // Simpan pengaduan ke database
        PermohonanInformasi::create([
            'name' => $request->name,
            'email' => $request->email,
            'instansi' => $request->instansi,
            'phone' => $request->phone,
            'tujuan' => $request->tujuan,
            'path' => $fileName,
            'status' => 1,
            'ip_address' => $request->ip(),
            'user_agent' => $request->header('User-Agent'),
        ]);

        return back()->with('success', 'Pengajuan permohonan informasi berhasil dikirim.');
    }
    


    public function index(){
        $tahun = now()->year -1;
        $indikator = IndikatorMakroSurvey::with('_indexIndikator')
            ->where('survey_id', $tahun)
            ->get();
        $data = IndikatorMakroSurvey::select('indikator_id', 'survey_id', 'target', 'realisasi', 'nasional')
            ->whereBetween('survey_id', [2021, 2026])
            ->where('indikator_id', 1)
            ->orderBy('indikator_id')
            ->orderBy('survey_id')
            ->get();
        // return $data;
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

        // $jumlahPengunjung = Cache::remember('jumlah_pengunjung', 60, function () {
        //     return DB::table('visitor_stats')->distinct('ip_address')->count('ip_address');
        // });

        $jumlahPengunjung = DB::table('visitor_stats')->distinct('ip_address')->count('ip_address');

        $pengunjungAktif = DB::table('visitor_stats')
            ->where('visited_at', '>=', now()->subDays(7))
            ->distinct('ip_address')
            ->count('ip_address');

        $rataKunjunganHarian = DB::table('visitor_stats')
            ->select(DB::raw('DATE(visited_at) as date'), DB::raw('COUNT(*) as total'))
            ->groupBy('date')
            ->get()
            ->avg('total');

        $jumlahHalamanDikunjungi = DB::table('visitor_stats')->count();
        $socials = SosialMedia::all();
        
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
            'faqs' => $faqs,
            'jumlahPengunjung' => $jumlahPengunjung,
            'pengunjungAktif' => $pengunjungAktif,
            'rataKunjunganHarian' => $rataKunjunganHarian,
            'jumlahHalamanDikunjungi' => $jumlahHalamanDikunjungi,
            'socials' => $socials,
            'tahun' => $tahun,
            'indikator' =>$indikator

        ];

        return view('guest.home.index',$sent );
    }

    public function detailRealisasi(Request $request){
        $tahun = $request->query('tahun', 2025);
        return view('guest.home.detail_realisasi', compact('tahun'));

    }

    public function getChartData($id)
    {
        $data = IndikatorMakroSurvey::where('indikator_id', $id)
            ->whereBetween('survey_id', [2021, 2026])
            ->orderBy('survey_id')
            ->get();

        return response()->json([
            'labels' => $data->pluck('survey_id'),
            'target' => $data->pluck('target'),
            'realisasi' => $data->pluck('realisasi'),
            'nasional' => $data->pluck('nasional'),
        ]);
    }

}
