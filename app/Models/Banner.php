<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'created_by',
        'updated_by',
        'status_id',

    ];  
    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    
    protected $table = 'banner';
}
