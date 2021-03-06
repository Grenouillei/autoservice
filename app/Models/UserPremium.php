<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserPremium extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'on_date',
        'off_date',
        'date',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id');
    }
}
