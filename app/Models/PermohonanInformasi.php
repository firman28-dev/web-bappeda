<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermohonanInformasi extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'email',
        'instansi',
        'phone',
        'tujuan',
        'path',
        'ip_address',
        'user_agent',
    ];
    protected $table = 'permohonan_informasi';
}
