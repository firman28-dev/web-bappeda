<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PegawaiBappeda extends Model
{
    use HasFactory;

    public function _bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidang', 'id');
    }

    protected $table = 'peka_pegawaibappeda';

}
