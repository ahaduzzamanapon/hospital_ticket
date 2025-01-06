<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class BookTicket extends Controller
{
    public function index(){
        if(Auth::check()){
            return view('bookticket');
        }
        else{
            return view('site.verifyNumber');
        }
    }
}
