<?php

namespace App\Services;

use App\Models\Currency;

class CurrencyService
{
    /**
     * return currency usd for user page
     * @return string
     */
    public function takeCurrencyUsd(){
        $currency = Currency::find(1);
        return $currency->usd;
    }

    /**
     * return currency euro for user page
     * @return string
     */
    public function takeCurrencyEur(){
        $currency = Currency::find(1);
        return $currency->eur;
    }
}
