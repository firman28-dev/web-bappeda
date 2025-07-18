<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'title',
        'category',
        'description',
        'instansi',
        'email',
        'ip_address',
        'user_agent',
    ];
    protected $table = 'public_complaints';

}
