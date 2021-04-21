<?php

namespace App\Http\Controllers;

use App\Services\FavoriteService;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    private $favoriteService;

    public function __construct(FavoriteService $favoriteService)
    {
        $this->favoriteService = $favoriteService;
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function addFavorite(Request $reg){
        $this->favoriteService->setFavorite($reg);
        return redirect()->back();
    }

    /**
     * @param Request $reg
     * @return mixed
     */
    public function deleteFavorite(Request $reg){
        $this->favoriteService->deleteFavorite($reg);
        return redirect()->back();
    }
}
