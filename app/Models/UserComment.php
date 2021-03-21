<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserComment extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_good',
        'comment'
    ];

    public function good_remake(){
        return $this->belongsTo(goods_remake::class, 'id', 'id_good');
    }
}
