<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_s',
        'name',
        'qty',
        'price',
        'brand',
        'code',
        'user_id'
    ];
}
