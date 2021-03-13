<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ContactRequest;
use App\Models\ContactModel;

class ContactController extends Controller
{
    public function submit(ContactRequest $reg) {

        $contact = new ContactModel();
        $contact->name = $reg->input('name');
        $contact->email = $reg->input('email');
        $contact->message = $reg->input('message');
        $contact->password = $reg->input('password');

        $contact->save();

        return redirect()->route('home');

        //dd($reg->input('email'));
       // $validation = $reg->validate([
       //     'name' => 'required|min:5|max:20',
       //     'email' => 'required|min:5|max:30'
       // ]);
    }
    public function allData(){
        $contact = new ContactModel();
        return view('layouts.messages' , ['data' => $contact ->orderBy('id','asc')->get() ]);

    }


}
