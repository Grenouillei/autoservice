<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\EditorInterface;
use App\Models\Favorite;

class FavoriteService implements EditorInterface
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
     * @param $req
     */
    public function create($req){
        $favorite = new Favorite();
        $favorite->id_good = $req->id_good;
        $favorite->id_user = Auth::user()->id;
        $favorite->save();
    }

    /**
     * remove product from favorites
     * @param $req
     */
    public function delete($req){
        $favorite = Favorite::find($req->id);
        $favorite->delete();
    }
}
