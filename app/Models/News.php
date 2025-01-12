<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'status_id',
        'image',
        'created_by',
        'updated_by',
        'bidang_id'

    ];  
    public function _bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }

    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function getFormattedCreatedAtAttribute()
    {
        return Carbon::parse($this->created_at)->locale('id')->translatedFormat('l, d F Y | H:i');
    }

    // protected $casts = [
    //     'updated_at' => 'datetime:d-M-Y H:i:s',
    //     'created_at' => 'datetime:d-M-Y H:i:s',
    // ];
    protected $table = 'news';
}
