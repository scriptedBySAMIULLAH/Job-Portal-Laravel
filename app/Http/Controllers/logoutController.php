<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
 

class logoutController extends Controller
{
   public function Logout(Request $request): RedirectResponse{
    //logout
    Auth::logout();
    $request->session()->invalidate();
 
    $request->session()->regenerateToken();

    $request->session()->forget('logoutmessage');
   //  after logout wherer to go

    return  redirect('/')->with('logoutmessage','GoodBye🤚');
   }
}
