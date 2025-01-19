<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Log;

use App\Models\companies;
use App\Models\jobseekers;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use App\Models\locations;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\userReg;
use Exception;

class RegisterController extends Controller
{

  ///////////////googleLogin////////////////////
  public function googleLogin()
  {

    return Socialite::driver('google')->redirect();
  }

  ////////////////////////googleverifer/////////////////////
  public function googlehandle()
  {

    $user = Socialite::driver('google')->user();
    $googlemail = $user->getEmail();
    $ouruser = User::where('email', $googlemail)->first();

    // dd($ouruser);

    if ($ouruser) {

      Auth::login($ouruser);

      //    $ouruser-role()
      $role = Auth::user()->role;
      if ($role == 'jobseeker') {


        return redirect()->route('jobseekerDashboard');
      } elseif ($role === 'company') {
        return redirect()->route('companyDashboard');
      } else {
        return redirect('/');
      }
    } else {
      return redirect()->back();
    }
  }

  //////////////////register///////////////////////////////////////////////////////////////////

  //////Userreg////////////////////////////////
  public function Userreg(Request $formdata)
  {

    // dd('rfef');

    //validation//
    $rules = [
      'name' => 'required|max:50|unique:users,name|regex:/[a-zA-Z][_\'\- ]*[a-zA-Z0-9]*[0-9]*+$/',
      'email' => 'required|string|max:200|email|unique:users,email',
      'password' => 'required|string|min:8',
      'role' => 'required|in:jobseeker,company'
    ];

    $validator = Validator::make($formdata->all(), $rules);

    if ($validator->fails()) {

      return back()->withErrors($validator)->withInput();
    }

    //if pass then create user
    $user = new User;
    $user->name = $formdata->input('name');
    $user->email = $formdata->input('email');
    $user->password = Hash::make($formdata->input('password'));
    $user->role = $formdata->input('role');
    $user->save();

    //here token generation 
    $this->emailTokenGenerator($formdata);
    $email = $formdata->email;
    return view('verification_notice', compact('email'));
  }


  //when user register then creates its token for verification //
  public function emailTokenGenerator(Request $formdata)
  {
    //  dd($formdata);
    //first create token
    $token = Str::random(15);
    $email = $formdata->email;
    $isUserExist = DB::table('users')->where('email', $email)->first();

    if ($isUserExist &&   $isUserExist->is_verified == 0) {


      DB::table('user_verification')->where('email', $email)->delete();//magical line if Usr already then del
      DB::table('user_verification')->insert(
        [
          'email' => $email,
          'token' =>  $token,
          'created_at' => now()
        ]

      );

      // mail sending
       $mailBag=[
           'userName'=> $formdata->name,
          'userEmail'=> $email,
          'token'=>$token
        ];

        // dd($mailBag);
        Mail::to($email)->send(new userReg($mailBag));

      return view('verification_notice', compact('email'));
    } else {

      return 'email is already verified';
    }
  }


  //a verification process


  public function emailVerificationProcess($token)
  {
 
    $user = DB::table('user_verification')->where('token', $token)->first();
   
    $userToken = $token;
   
    $useremail = $user->email;
    
    $verified = DB::table('user_verification')->where('email', $useremail)->where('token', $userToken)->first();

    if ($verified) {

      //verified

      DB::table('users')->where(
        'email',
        $useremail
      )->update([
        'email_verified_at' =>now(),
        'is_verified'=>1
      ]);
     
      $userType = DB::table('users')
        ->where('email', $useremail)->first();

      if ($userType->role === 'company') {
        $locations=locations::all();
        $userid=$userType->id;

        return view('companyReg',compact('userid','locations'));


      } else if ($userType->role === 'jobseeker') {

        $userid=$userType->id;

        $name=$userType->name;
        return view('jobseekerreg',compact(['userid','name']));

      } else {

        return view('Login')->with('success');
      }
    } else {


      return 'Invalid Token/Email';
    }
  }

  // atype of user reg
  public function RegisterationBoth(Request $formdata)
  {

    $rules = [
      // 'name' => 'required|string|max:50|unique:users,name',
      // 'email' => 'required|string|max:200|email|unique:users,email',
      // 'password' => 'required|string|min:8',
      // 'role' => 'required|in:jobseeker,company',
      // 'picture' => 'required|image|max:2048|mimes:jpeg,png,gif', // Max size 2MB and specific file types

    ];


    if ($formdata->role === 'jobseeker') {
      $rules = [
        'cv' => 'required|file|max:2048|mimes:pdf,doc,docx',
        'picture' => 'required|image|max:2048|mimes:jpeg,png,gif,JPG', // Max size 2MB and specific file types
        
      ];
    }

    if ($formdata->role === 'company') {
      $rules = [
        'picture' => 'required|image|max:2048|mimes:png,jpeg,gif,JPG',
        'description' => 'required',
        'company_email' => 'required|unique:companies,companyemail',
        'phone_number' => 'required|string|max:13|min:11|unique:companies,phonenumber|regex:/^\d{4}\d{7}$/',
        'company_name' => 'required|unique:companies,companyname',
        'web_url' => 'required|unique:companies,websiteurl',
      ];
    }
    $validator = Validator::make($formdata->all(), $rules);
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }
    // //now they are validated 
    ////now creation of user done know its time to register type of user

    if ($formdata->role === 'jobseeker') {

      $picturePath = $formdata->file('picture')->store('jobseekerpics', 'public');
      $cv = $formdata->file('cv')->store('jobseekercv', 'public');
      $jobseekercreate = Jobseekers::create([
        'user_id' => $formdata->userid, // Set the user_id
        'jobseekername' => $formdata->name,
        'CV' => $cv,
      ]);

      $jobseekercreate->update([
        'picture' => $picturePath, // Store the path of the picture
      ]);
      if ($jobseekercreate) {
        return redirect()->route('login')->with('success', 'Congratulations! Your account has been successfully created. You can now log in.');
      }
    } elseif ($formdata->role === 'company') {

      $picturePath = $formdata->file('picture')->store('company_logo', 'public');
      $company = companies::create([
        'user_id' => $formdata->userid,
        'companyname' => $formdata->company_name,
        'companyemail' => $formdata->company_email,
        'phonenumber' => $formdata->phone_number,
        'location_id' => $formdata->location_id,
        'company_type' => $formdata->company_type,
        'websiteurl' => $formdata->web_url,
        'numberofemployees' => $formdata->employees_count,
        'description' => $formdata->description
      ]);
      $company->update([
        // Store the path of the picture
        'picture' => $picturePath,
      ]);
      if ($company) {
        // session('success')->flash('😎Congratulations! Your account has been successfully created. You can now log in.');//its wrong way
        return redirect()->route('login')->with('success', 'Congratulations! Your account has been successfully created. You can now log in.');
      }
    } else {
      return "hello"; //maybe admin comes but not yet;) added who saty admins are registered?
    }
  }


  //////////////////////login/////////////////////////////////////////////
  public function Login(Request $formdata)
  {
    $user = User::where('email', $formdata->input('email'))->first();

    if($user && $user->status=='Block'){

      return redirect()->back()->with('err',"Your account is suspended temporarily");

    }
    else{
   //&& $user->is_verified==1
    if ($user &&  $user->password) {
      Auth::login($user);
      $role = Auth::user()->role;
      
      if ($role == 'jobseeker') {


        return redirect()->route('jobseekerDashboard');
      } else if ($role == 'company') {

        return redirect()->route('companyDashboard');
      } else if ($role == 'admin') {

        return redirect()->route('AdminIndex');
      }
    } else {
      session()->flash('err','Invalid credentials');
      return redirect()->back();
    }
  }
  }
}
