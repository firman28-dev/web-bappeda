<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiTerbaik extends Model
{
    use HasFactory;
    protected $fillable = [
        'pegawai_id',
        'path',
        'tahun',
        'bulan',
        'created_by',
    ];  

    public function getNamaBulanAttribute()
    {
        $bulan = [
            1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
            5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
            9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
        ];

        return $this->bulan ? $bulan[$this->bulan] : '-';
    }

    protected $table = 'pegawai_terbaik';

}
