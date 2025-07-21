<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Magang extends Model
{
    use HasFactory;
     protected $fillable = [
        'name',
        'universitas',
        'jurusan',
        'start',
        'end',
        'tujuan',
        'email',
        'phone',
        'ip_address',
        'user_agent',
        'path',
        'status',
        'note'
    ];

    protected $casts = [
        'started_at' => 'datetime:Y-m-d',
        'ended_at' => 'datetime:Y-m-d',
    ];
    protected $table = 'magang';
}
