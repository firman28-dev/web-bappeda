<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bidang extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'label',
        'status_id',
    ];  
    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function _news()
    {
        return $this->hasMany(News::class, 'bidang_id');
    }
    protected $table = '_bidang';

}
