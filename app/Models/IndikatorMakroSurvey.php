<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndikatorMakroSurvey extends Model
{
    use HasFactory;

    public function _indexIndikator()
    {
        return $this->belongsTo(IndikatorMakro::class, 'indikator_id', 'id');
    }
    protected $table = 'indikator_makro_survey';
    
}
