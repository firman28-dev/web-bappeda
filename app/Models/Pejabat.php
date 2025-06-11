<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pejabat extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'group_id',
        'bidang_id',
        'created_by',
        'updated_by',
        'path'
    ];  

    public function _bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang_id', 'id');
    }
    public function _group()
    {
        return $this->belongsTo(Group::class, 'group_id', 'id');
    }
    protected $table = 'pejabat';

}
