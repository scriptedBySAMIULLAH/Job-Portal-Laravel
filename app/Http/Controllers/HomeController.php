<?php

namespace App\Http\Controllers;

use App\Mail\forgotPassword;
use App\Models\job_save;
use App\Models\jobseekers;
use App\Models\locations;
use App\Models\User;
use App\Models\joblisting;
use App\Models\companies;
use App\Models\contactUs;
use App\Models\skills;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{
    //  yes our home controller
    public function index(Request $formdata)
    {
  
        
        $Proficency = $formdata->input('Proficiency', 'All'); //if you dont get any value then its aboviious na choose default 


        //grab the form of search as using same Request route for filter and sesrch
        
       
      

        $searchquery = $formdata->input('searchquery');
        
        if ($searchquery) {
            $rules=[

                'searchquery'=>'alpha'
             ];//check that no serch contains other than text

             $validator = Validator::make($formdata->all('searchquery'), $rules);

             if($validator->fails()){
                 
            return redirect()->back()->with('errors','Invalid String Enterd!🙄');
             }

            $jobs = joblisting::search($searchquery)
                ->get(); //here search is algolia method it will not allow you to add relationships like with or limit or any other method so you first grab the search result then apply relation on it  actuallly on UI you access it alrady like eg $job->User->companyinfo->companyname
            //   dd(  $jobs);
            // what if search result mean no that record found
            if ($jobs->isEmpty()) {
                //if no job found
                return redirect()->back()->with('noJobFound', 'noJobFound');
            } else {
                return view('indexTail', compact('jobs', 'Proficency'));
            }
        } else {


        //for footer 

        // $locations=locations::all();

        //    dd($locations);
            //you know this will bring joblisiting and thire assocaited tables  data within it
            $jobs = joblisting::with(['location', 'skills', 'User.companyinfo'])->Proficency($Proficency)->limit(5)->orderByDesc('created_at')->get();
            //->orderByDesc('created_at')  this give latest job
            // you know limit so on latest job sectionn we show top tens



            return view('indexTail', compact('jobs', 'Proficency'));
        }
    }
    // a jobSummary

    public function jobSummary($id)
    {
        $jobDetail = joblisting::with('location', 'User.companyinfo')->findOrFail($id);
        // dd($jobDetail);
        return view('jobSummary', compact('jobDetail'));
    }


    // a jobsave by jobseeker in a  midddle table

    public function savejob($id)
    {
        $jobId = $id;
        // dd( $jobId);
        $authuserid = auth()->id();
        //grab js id from js table with help of user_id
        $jobSeeker = jobseekers::where('user_id', $authuserid)->first();

        $JobseekerId = $jobSeeker->id;

        //wait before qury ensure some folk cant save same job more than one

        $alreadysaved =  job_save::where('job_id', $jobId)->where('jobseeker_id', $JobseekerId)->exists();



        if (!$alreadysaved && $JobseekerId) {

            job_save::create([


                'job_id' => $jobId,
                'jobseeker_id' => $JobseekerId,
            ]);



            return redirect()->back()->with('Jobsaved', 'Job Save Successfully🍓');
            // return view('dashboard', compact('user'));
        } else {

            return redirect()->back()->with('err', 'Why saving Twice?🤦');
        }
    }



    ////////////////////jobfeed/////////////////////////////////


    public function jobfeed(Request $formdata)
    {

        $locations=locations::all();
        $searchquery= $formdata->input('searchquery','');
        if($formdata->searchquery  && $formdata->location){
        // $locations=locations::all();
        // $searchquery= $formdata->input('searchquery','');
        $location=$formdata->input('location',null);
        // dd($location);
            /////////////algoloia search//////////////////////

            $rules=[


                'searchquery'=>'string'
            ];

            $validator=Validator::make($formdata->all('searchquery'),  $rules);
            if(  $validator->fails()){

                return redirect()->back()->with('err','Invalid Input Entered, must be letters');
            }

            if( $searchquery && $location){//both comes toghther
                $jobs = joblisting::search($searchquery)->where('location_id', $location)->get();;//algolia search

            //   joblisting::where()



              if($jobs->isNotEmpty()){
                // $jobs =$jobs->where('location_id',$location);//now we waht algolia give us take it pick location id and find it
                return view('jobFeedPage',compact('jobs','locations','searchquery'));

              }

              else{

                return redirect()->back()->with('err','No Job Found');
              }
            
            }

        }
            else{
                //in normal case if some folk dont have search or filter
                // paginate and get are nearly a same thing

                $jobs = joblisting::with(['location', 'skills', 'User.companyinfo'])
                ->paginate(6);
               
                
                
               
                
                // $jobs = $jobs->skip(10);//skip first ten jobs
                //for pagination

                
            //    dd(  $jobs );

                // $jobs= $jobs->paginate(1);
         
              return view('jobFeedPage',compact('jobs','locations','searchquery'));

            }
            

    }


    //////////////showForgotPasswordform////////////////


    public function showForgotPasswordform(){



            return view('showForgotPasswordform');
    }


    //////////////////////processForgotPasswordform///////////////////


    public function processForgotPasswordform(Request $formdata){

        $rules=[

            'email'=>'required|exists:users,email'
        ];
        $validator=Validator::make($formdata->all(), $rules);

        if( $validator->fails()){

            return redirect()->back()->with('errors','Invalid Email Enterd!🙄');
        }
        //get user email

        $useremail=$formdata->email;
        
        //make token which is unique against its email in password_reset_tokens table email is P.K as not from d/f devices at same time user try to change password

        $token=Str::random(15);
        //now put user email and token in password_reset_tokens table
        //but we have to make model which talks dont woryy give try to another way!

        //before puting check it already not exist if ,then del
        DB::table('password_reset_tokens')->where('email',$useremail)->delete();
        DB::table('password_reset_tokens')->insert([


            'email'=>  $useremail,
            'token'=>  $token,
            'created_at'=>now()
        ]);//ignore \DB errors

        //now user exists and tken ,email put in reset token table now send mail with token and user info

        $userdata=User::where('email', $useremail)->first();
        
        //make array send to mail tmplate

        $mailBag=[

            'userdata'=> $userdata,
            'token'=> $token
        ];

        //send mail
        Mail::to($useremail)->send(new forgotPassword($mailBag));

        return redirect()->back()->with('success','Check Your Email ,reset link is sent📩.');




    }

    public function PasswordResetform($token){
        $tokenexists=DB::table('password_reset_tokens')->where('token',$token)->first();
        $userEmail=$tokenexists->email;
        // dd(   $userEmail);

        if(!$tokenexists){
            return redirect()->back()->with('errors','Invalid Token !🙄');

        }
        //if token then view rest form

        return view('ResetPasswordForm',['userEmail'=>$userEmail]);

    }
        //now reset the password man!
    public function ResetPassword(Request $formdata){
       
       $thatUserEmail=$formdata->userEmail;
       $newPassword=$formdata->newpassword;
    //   dd( $newPassword);

       $rules= [

        'newpassword'=>'required|string|min:8'
       ];

        $validator=Validator::make($formdata->all('newpassword'),$rules);
        // dd(   $validator);

        if( $validator->fails()){

            return redirect()->back()->withErrors($validator);
        }
        

           

            $user=User::where('email',  $thatUserEmail)->update([

                'password'=>Hash::make($newPassword)
            ]);
          
            return redirect()->route('login')->with('success','Password Change! You can login Know.');

    }


    public function handleContactUs(Request $formdata){

        $rules=[
            'subject'=>'required|string|max:100',
            'message'=>'required|string'

        ];

        $validator=Validator::make($formdata->all('subject','message'),$rules);

        if(  $validator->fails()){


            return back()->withErrors($validator)->withInput();
        }

        $data= new contactUs();
        $data->user_id= $formdata->userid;
        $data->subject= $formdata->subject;
        $data->message= $formdata->message;
        $data->save();

        return redirect()->back()->with('success',"thanks");




    }
}
