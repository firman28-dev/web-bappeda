<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'status_id',
        'created_by',
        'updated_by',
    ];  

    public function _status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }

    protected $table = 'faq';
}
