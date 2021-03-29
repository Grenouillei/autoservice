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

    public function good(){
        return $this->belongsTo(Good::class, 'id', 'id_good');
    }

    public function user(){
        return $this->belongsTo(User::class, 'id', 'id_user');
    }
}
