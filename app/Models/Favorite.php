<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_user',
        'id_good',
    ];

    public function good(){
        return $this->belongsTo(Good::class, 'id_good', 'id');
    }
    public function user(){
        return $this->belongsTo(User::class, 'id_user', 'id');
    }
    public function getGood(){
        return $this->good()->get()->toArray();
    }

}
