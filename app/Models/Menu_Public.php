<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu_Public extends Model
{
    use HasFactory;
    protected $fillable = [
        'parent_id',
        'name',
        'link',
        'icon',
        'order_no',
        'status_id',
        'target_id',
        'created_by',
        'updated_by'
    ];  

    public function _parent()
    {
        return $this->belongsTo(Menu_Public::class, 'parent_id');
    }

    // public function _children()
    // {
    //     return $this->hasMany(Menu_Public::class, 'parent_id')->orderBy('order_no')->with('_children');
    // }
    public function _children()
    {
        return $this->hasMany(Menu_Public::class, 'parent_id')
            ->where('status_id', 1)
            ->orderBy('order_no')
            ->with('_children');
    }

    protected $table = 'menu_public';

}
