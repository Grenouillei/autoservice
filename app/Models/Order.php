<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'phone',
        'city',
        'id_goods',
        'qty_goods',
        'sum_goods',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }

    public function getUsers(){
        return $this->user()->get()->toArray();
    }
}
