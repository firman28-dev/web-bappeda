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
        'bidang_id',
        'category_id'

    ];  
    public function _bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }

    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    public function _user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }
    public function _category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
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
