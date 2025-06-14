<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class API_Edatabase_Controller extends Controller
{
    public function curlListMakro($jenis = null, $id = null)
    {
        if ($jenis === 'list_makro') {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://sakatoplan-apps.sumbarprov.go.id/edatabase/makro/api_list_makro', [
                'username' => 'edatabase',
                'password' => '123!@#'
            ]);

            return response()->json($response->json());
        }

        if ($jenis === 'grafik' && $id) {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])->post("https://sakatoplan-apps.sumbarprov.go.id/edatabase/makro/api_grafik_makro/{$id}", [
                'username' => 'edatabase',
                'password' => '123!@#'
            ]);

            $json = $response->json();

            if (!isset($json['data'])) {
                return "Data belum tersedia";
            }

            $makro = $json['data'];
            $nasional = $json['nasional'];
            $thn = $json['tahun'];
            $min_thn = $json['min_tahun'];
            $max_thn = $json['max_tahun'];
            $nama_data = $json['nama_data'];

            if (!$makro) {
                return "Data belum tersedia";
            }

            $min_data = min($makro);
            $max_data = max($makro);
            

            return response()->json([
                'data' => $makro,
                'nasional' => $nasional,
                'tahun' => $thn,
                'min_tahun' => $min_thn,
                'max_tahun' => $max_thn,
                'nama_data' => $nama_data,
                'data_terendah' => $min_data,
                'data_tertinggi' => $max_data,
            ]);
        }

        return response()->json(['error' => 'Invalid request'], 400);
    }

    
}
