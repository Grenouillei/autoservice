<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Spareparts;
use phpDocumentor\Reflection\Types\Array_;
use Illuminate\Support\Facades\DB;

class SparepartsController extends Controller
{
// public $temp;
// public $arr = array();

// public function outPutt(){
//     $part = Spareparts::all();
//     return view('home' , ['parts' => $part->take(20)]);
//    // return view('home' , ['parts' => Spareparts::all()]);

// }
// public function openNewStr(){
//     return view('new' , ['news' => Spareparts::all()]);

// }
// public function searchNew(Request $request){
//     $str = $request->text;

//     if($str==null)
//     {
//         return redirect()->route('home');
//     }
//     else
//     {
//         $mass2 = DB::table('spareparts')
//             ->where('name', 'like', "%$str%")->get('name');
//         return view('search', ['array'=>$mass2], ['mass' => Spareparts::all()]);
//     }
       // foreach ($mass1 as $item) {

         //   $temp = $item->name;
         //   $temp = strval($temp);
            //$_GET['text']
         //   $pos = strpos($temp, $str);

        //    if($pos === false) {
        //    }
        //    else{
        //        $arr[] = $temp;
        //        print($temp);
        //        print(boolval($pos));
        //        print("<br>");
        //    }
       // }

  //  }


}
