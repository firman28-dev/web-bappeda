<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'status_id',
    ];  
    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    protected $table = 'category';
}
