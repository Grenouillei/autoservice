<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class goods_remake extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'brand',
        'price',
        'code',
        'qty'
    ];
}
