<?php

namespace App\Services;

use Carbon\Carbon;
use ErrorException;
use App\Models\User;
use App\Models\UserPremium;
use Illuminate\Support\Facades\Auth;

class PremiumService{

    /**
     * set premium for user
     */
    public function setUserPremium(){
        $user_p = new UserPremium();
        $user_p->id = Auth::user()->id;
        $user_p->on_date = strtotime('now');
        $user_p->off_date = strtotime("+1 minutes");
        $user_p->date = Carbon::now()->addDay()->addHours(3);
        $user_p->save();

        $user = User::find(Auth::user()->id);
        $user->premium = true;
        $user->save();
    }

    /**
     * checking user premium for further remove
     */
    public function checkUserPremium(){
        $current_date = strtotime('now');
        $user_p = UserPremium::find(Auth::user()->id);
        if ($user_p){
            if ($user_p->off_date <= $current_date) {
                $user = User::find(Auth::user()->id);
                $user->premium = false;
                $user->save();
                $user_p->delete();
            }
        }
    }

    /**
     * return date of ending premium for user page
     * @throws \Exception
     * @return mixed
     */
    public function getDateOfEndingPremium(){
        try{
            $user_p = UserPremium::find(Auth::user()->id);
            return $user_p->date;
        }catch (ErrorException $e) {
            return false;
        }
    }
}
