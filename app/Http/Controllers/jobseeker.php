<?php

namespace App\Http\Controllers;

use App\Mail\ApplicationNotification;
use App\Models\application;
use App\Models\companies;
use App\Models\job_save;
use Illuminate\Support\Facades\Validator;
use App\Models\joblisting;
use App\Models\jobseekers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;

class jobseeker extends Controller
{
    //show dashboard
    public function showDashboard()
    {

        if (Auth::user()->role == 'jobseeker') {
            //you need to find assocaited data hn, as relationship define 
            //you first write assocated table first which is user hn 
            $user = User::with('jobseeker')->find(auth()->id());
            //    dd(  $user);// user jo assocate jobseeker table mn on basis of user_id talash kro logged iin user ki id ko at that time
            $getjobseeker = $user->jobseeker; //now you get specific jobseeker
            // you can also say when you dd it give both parent and assocaited table know you go to assocated table like that
            $jobseekerPicture = $getjobseeker->picture;
            // dd(   $jobseekerPicture);
            // jobseekers are assocated but they are in users so first go to user then jobseeker throough define relationship fun name 


            //////////////////now show saved jobs//////////////////////

            //now displaying
            $jobseeker = jobseekers::with('user')->where('user_id', auth()->id())->get()->first(); //get the auth JS id
            //    $user=jobseekers::with('saves')->get(); this is wrong if we put get it will get all jobseekers with or not without assoacted saved job
            // its better to find auth js and get its jobs 



            $jobseekerwithjob = jobseekers::with(['saves', 'saves.skills', 'saves.User.companyinfo', 'apply.skills', 'apply.User.companyinfo', 'applications'])->where('user_id', auth()->id())->get()->first(); //only find auth one
           
                // dd($jobseekerwithjob);                  
            //get the url so navigqte back to dashboard
            session(['dashboard.url' => url()->current()]);

            //for job statuses
            $ids = application::where('jobseeker_id', $getjobseeker->id)->get();
            //   dd($ids);
            return view('jobseekerDashboard', ["jobseekerPicture" => $jobseekerPicture, "jobseekerwithjob" => $jobseekerwithjob, 'ids' => $ids]);
        } else {
            return redirect()->back();
        }
    }



    /////////////////////////////delete saveJob/////////////////////

    public function jobdestroy($id)
    {
        // dd($id);
        $jobseeker_id = jobseekers::with('user')->where('user_id', auth()->id())->get()->first();
        $job_id = $id;
        if ($jobseeker_id) {
            $jobseeker_id->saves()->detach($job_id);
            //you are deleting from  m-m raltion job_save ---->detach hmm!
            return response()->json(['success', 'Job Deleted SuccessFully👌']);
        } else {

            return redirect()->back()->with('error', 'unable to found You');
        }
    }

    public function jobapply($id)
    {
        $jobid = $id;
        $incompanyid = joblisting::where('id', $jobid)->pluck('user_id')->first(); //aim is store company_id in application table thats why i query first jobtable to get user who created and then 
        //    dd( $incompanyid);
        $outcompanyid = companies::where('user_id', $incompanyid)->first(); //on basis of userid search that user in company table is owner actually  
        // dd($outcompanyid);
        $authid = Auth::id();

        $jobseeker = jobseekers::where('user_id', $authid)->first();
        //  dd($jobseeker);
        $jobseekerid =  $jobseeker->id;
        //  dd($jobseekerid);
        // $job = application::with(['jobseeker', 'jobs'])
        // ->where('jobseeker_id', $jobseekerid)
        // ->where('job_id', $jobid)
        // ->first();

        // dd($job);
        //         $jobApplications = application::where('job_id', $jobid)->get();
        // dd($jobApplications);
        $jobseekerCV = $jobseeker->CV;
        // dd( $jobseekerCV);


        $alreadyapply = application::where('job_id', $jobid)->where('jobseeker_id', $jobseekerid)->exists();

        

        if (!$alreadyapply && $jobseekerid) {

            $jobapply = new application();
            $jobapply->company_id = $outcompanyid->id;
            $jobapply->job_id = $jobid;
            $jobapply->jobseeker_id = $jobseekerid;
            $jobapply->cv = $jobseekerCV;
            $jobapply->save();
            //try to send notification to company taht  you have received applications

            // define array of data which you want such as commpay email,jobseeker info,job where applied occured


            $jobseekeremail = User::where('id', Auth::id())->pluck('email')->first();
            // dd( $jobseekeremail);
            $jobData = joblisting::where('id', $id)->first(); //for getting that job
            $mailBag = [
                'companyData' => $outcompanyid, //thats objs
                'jobseekerData' => $jobseeker,
                'jobData' => $jobData,
                'cv' => $jobapply->cv,
                'jobseekeremail' => $jobseekeremail

            ];
            // dd($jobapply->cv);
            $companyEmail = $outcompanyid->companyemail;

            Mail::to($companyEmail)->send(new ApplicationNotification($mailBag));

            return redirect()->back()->with('jobapply', 'Job Apply Successfully🍊');
        } else {
            return redirect()->back()->with('jobapplytwice', 'Why Applying Twice?🤦');
        }
    }


    //////////////////////delete apply job///////////////////

    public function applyjobdelete($id)
    {
        $delJobid = $id;
        $jobseeker_id = jobseekers::with('user')->where('user_id', auth()->id())->get()->first();
        $job_id = $id;
        if ($jobseeker_id) {
            $jobseeker_id->apply()->detach($job_id);
            return response()->json(['success', 'Job Deleted SuccessFully👌']);
        } else {
            return redirect()->back()->with('error', 'unable to found You');
        }
    }




    //////////////////////////setttings//////////////////////////////

    public function jobseekerUpdateProfile(Request $formdata)
    {
        

        $id=Auth::id();

 

        $rules = [


            'name' => 'max:50|regex:/[a-zA-Z][_\'\- ]*[a-zA-Z0-9]*[0-9]*+$/',
            'email' => 'string|max:200|email|unique:users,email,'.$id.'id',
            'cv' => 'file|max:2048|mimes:pdf,doc,docx',
            'picture' => 'image|max:2048|mimes:jpeg,png,gif,JPG', // Max size 2MB and specific file types
            'password' => 'required|string|min:8',
        ];

        $validator=Validator::make($formdata->all(),$rules);

        if(    $validator->fails()){


            return back()->withErrors($validator)->withInput();
        }


    $user = User::findOrFail(auth()->id());
    $user->name = $formdata->input('name');
    $user->email = $formdata->input('email');

    if($formdata->password){

        $user->password = bcrypt($formdata->password);

    }
    
    $user->save();

    //update JS

    $jobseekerUpdate=jobseekers::where('user_id',$id)->first();

    $jobseekerUpdate->jobseekername= $formdata->input('name');
    // dd($jobseekerUpdate);
        if( $formdata->file('picture') ){

            $picturepath=$formdata->file('picture')->store('jobseekerpics','public');

            $jobseekerUpdate->picture= $picturepath;



        }
        if( $formdata->file('cv') ){

            $cvpath=$formdata->file('cv')->store('jobseekercv','public');

            $jobseekerUpdate->CV= $cvpath;



        }
        $jobseekerUpdate->save();

        return redirect()->back()->with('ProfileUpdated',"update Successfully");

        
    }



    //show profile setting form to user 

    public function JobseekerProfileSetting(){
        if (Auth::user()->role == 'jobseeker') {

        $user = User::with('jobseeker')->find(auth()->id());
        $getjobseeker = $user->jobseeker;
        $jobseekerPicture = $getjobseeker->picture;

        return view('JobseekerSettings',['jobseekerPicture'=>$jobseekerPicture]);
        }
                


    }
}
