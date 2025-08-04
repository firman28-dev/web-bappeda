<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KritikSaran extends Model
{
    use HasFactory;
     protected $fillable = [
        'nama',
        'email',
        'judul',
        'pesan',
        'ip_address',
        'user_agent',
    ];
    protected $table = 'kritik_saran';
}
