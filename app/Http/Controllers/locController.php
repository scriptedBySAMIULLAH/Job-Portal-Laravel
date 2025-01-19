<?php

namespace App\Http\Controllers;
use App\Models\locations;
use App\Models\User;
use Illuminate\Http\Request;

class locController extends Controller
{
    public function showRegistrationForm()
    {
        $locations=locations::all();
        return view('companyReg', compact('locations'));
         // Check the contents of $locations
        // return view('companyReg', ['locations' => $locations]);
    }
    
}
