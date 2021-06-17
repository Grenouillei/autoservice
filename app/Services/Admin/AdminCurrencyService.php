<?php

namespace App\Services\Admin;

use App\Models\Currency;

class AdminCurrencyService
{
    /**
     * change admin password
     * @param $reg
     */
    public function changeAdminPassword($reg){
        $currency = Currency::find(1);
        $currency->admin_pass = $reg->password;
        $currency->save();
    }

    /**
     * update currencies by parsing another site
     * with strpos and substr methods
     */
    public function updateCurrencies(){
        $content = file_get_contents('https://finance.i.ua/');

        $usd = strpos($content, '<span>');
        $rate_usd= substr($content, $usd);
        $usd = strpos($rate_usd, '</span>');
        $rate_usd = substr($rate_usd, 0, $usd);
        $usd = substr($rate_usd, 6);
        $result_usd = substr($usd, 0, -2);

        $eur = strpos($content, 'EUR');
        $rate_eur = substr($content, $eur);
        $eur = strpos($rate_eur, '</span>');
        $rate_eur = substr($rate_eur, 0, $eur);
        $eur = substr($rate_eur, 48);
        $result_eur = substr($eur, 0, -2);

        $currency = Currency::find(1);
        $currency->usd = $result_usd;
        $currency->eur = $result_eur;
        $currency->save();
    }
}
