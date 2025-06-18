<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosialMedia extends Model
{
    use HasFactory;
    protected $fillable = ['platform', 'embed_code'];

    protected $table = 'social_medias';


}
