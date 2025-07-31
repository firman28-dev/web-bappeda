<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PegawaiBappeda;
use App\Models\PegawaiTerbaik;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class PegawaiTerbaikController extends Controller
{
    public function index(){
        $session_date = Session::get('tahun_terpilih');
        // return $session_date;
        $pegawai = PegawaiTerbaik::where('tahun', $session_date)
            ->orderBy('bulan')
            ->get();
        return view('admin.pegawai_terbaik.index', compact('pegawai'));
    }

    public function create(){
        $session_date = Session::get('tahun_terpilih');
        $pegawai = PegawaiBappeda::all();
        $sent = [
            'date' => $session_date,
            'pegawai' => $pegawai
        ];
        return view('admin.pegawai_terbaik.create', $sent);


    }
    public function store(Request $request){
        $request->validate([
            'pegawai_id' => 'required|int',
            // 'path' => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'path' => 'nullable',
            'bulan' => 'required|int',
            'tahun' => 'required|int'
        ]);

        $existing = PegawaiTerbaik::where('bulan', $request->bulan)
            ->where('tahun', $request->tahun)
            ->first();
        if ($existing) {
            return back()->with('success','Bulan tidak boleh diinput 2 kali')->withInput();
        }
        $user = Auth::user();

        $file = $request->path;

        try {
            $pegawai_terbaik = new PegawaiTerbaik();
            $pegawai_terbaik->pegawai_id = $request->pegawai_id;
            $pegawai_terbaik->bulan = $request->bulan;
            $pegawai_terbaik->tahun = $request->tahun;
            $pegawai_terbaik->created_by = $user->id;

            if ($file) {
                $unique = uniqid();
                $fileName = $unique.'_'.time(). '_' . $file->getClientOriginalName();
                $file->move($_SERVER['DOCUMENT_ROOT']. '/uploads/pegawai_terbaik/', $fileName);
                $pegawai_terbaik->path = $fileName;
            }
            $pegawai_terbaik->save();
            return redirect()->route('pegawai-terbaik.index')->with('success', 'Berhasil Menambahkan Data');

        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy($id){
        $pegawai = PegawaiTerbaik::findOrFail($id);
        // return $page_system;
        if($pegawai->path){
            $oldPhotoPath = $_SERVER['DOCUMENT_ROOT']. '/uploads/pegawai_terbaik/' .$pegawai->path;
            if (file_exists($oldPhotoPath)) {
                unlink($oldPhotoPath);
            }
        }
        $pegawai->delete();
        return redirect()->back()->with('success', 'Berhasil Menghapus Data');
    }

}
