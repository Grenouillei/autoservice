<?php

namespace App\Http\Controllers\Admin;

use App\Services\Admin\AdminCurrencyService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ACurrencyController extends Controller
{
    private $adminCurrencyService;

    public function __construct(AdminCurrencyService $currencyService)
    {
        $this->adminCurrencyService = $currencyService;
    }

    /**
     * change admin password
     * @param Request $reg
     * @return mixed
     */
    public function updateAdminPassword(Request $reg){
        $this->adminCurrencyService->changeAdminPassword($reg);
        return redirect()->back();
    }

    /**
     * update currencies
     * @return mixed
     */
    public function updateCurrencies(){
        $this->adminCurrencyService->updateCurrencies();
        return redirect()->back();
    }
}
