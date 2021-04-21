<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;

class FavoriteService
{
    /**
     * return all favorites
     * @return mixed
     */
    public function getAllFavorites(){
        return Favorite::all();
    }

    /**
     * add product to favorites
     * @param $reg
     */
    public function setFavorite($reg){
        $favorite = new Favorite();
        $favorite->id_good = $reg->id_good;
        $favorite->id_user = Auth::user()->id;
        $favorite->save();
    }

    /**
     * remove product from favorites
     * @param $reg
     */
    public function deleteFavorite($reg){
        $favorite = Favorite::find($reg->id);
        $favorite->delete();
    }
}
