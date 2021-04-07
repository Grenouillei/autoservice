<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Good extends Model
{
    public $timestamps = false;
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'brand',
        'price',
        'code',
        'qty',
        'able'
    ];

    public function comments(){
        return $this->hasMany(UserComment::class, 'id_good', 'id');
    }

    public function favorites(){
        return $this->hasMany(Favorite::class, 'id_good', 'id');
    }

    public function carts(){
        return $this->hasMany(Cart::class, 'id_good', 'id');
    }
}
