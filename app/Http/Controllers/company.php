<?php

namespace App\Http\Controllers;

use App\Models\education;
use App\Models\rating;
use App\Models\skil_rate;
use Illuminate\Support\Facades\Validator;
use App\Models\joblisting;
use App\Models\locations;
use App\Models\User;
use App\Models\skills;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use APP\Http\Controllers\log;
use App\Models\application;
use App\Models\BasicBio;
use App\Models\companies;
use Illuminate\Validation\Rule;

class company extends Controller
{
  //show companyDashboard
  public function showCompanyDashboard()
  {

    $skills = skills::all();
    $locations = locations::all();

    // dd( $skills);
    $user = User::with('companyinfo')->find(auth()->id());

    //go in company and find log user id
    // dd  ($company);
    //you havve company table and user table acccess
    $company_details = $user->companyinfo; //model relationship
    $company_name = $company_details->companyname;
    $company_logo = $company_details->picture;
    $company_locationId = $company_details->location_id;
    // dd  ($company_locationId);
    if (Auth::user()->role == 'company') {


      $company_location = locations::where('id', $company_locationId)->pluck('name')->first();
      // dd($company_location);
      //all the jobs posted (your jobs)
      // $jobs = joblisting::with('skills')->get();

      $jobs = JobListing::with(['skills', 'applications.jobseeker'])
        ->where('user_id', auth()->id())  // Filter by authenticated user's ID
        ->paginate(2);
      //  dd  ( $jobs);
      // $jobapplicants = application::with('jobseeker.user', 'jobs')->where('company_id', $company_details->id)->paginate(2);
      // dd( $jobapplicants);
      session(['dashboard.url' => url()->current()]);
      return view('companyDashboard', ["company_name" => $company_name, "company_logo" => $company_logo, "skills" => $skills, "locations" => $locations, 'jobs' => $jobs,  'company_details' => $company_details, 'company_location' => $company_location, 'company_locationId' => $company_locationId]);
    } else {
      return redirect()->back();
    }

    /////////your jobs////////////////////






  }




  //show Applicants

  public function Applicants(Request $fromdata)
  {
    $user = User::with('companyinfo')->find(auth()->id());
    $company_details = $user->companyinfo;


    if (auth()->user()->role == 'company') {

      $sortStatus = $fromdata->input('sortStatus');
      // dd($sortStatus);

      if ($sortStatus) {

        switch ($sortStatus) {
          case ($sortStatus == 'Pending'):

            $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->where('status', 'Pending')->get();

            if ($jobapplicants->isNotEmpty()) {

              return view('companyapplicant', ['jobapplicants' => $jobapplicants]);
            } else {
              return redirect()->back()->with('err', "No record found");
            }


          case ($sortStatus == 'Shortlisted'):

            $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->where('status', 'Shortlisted')->get();
            if ($jobapplicants->isNotEmpty()) {
              return view('companyapplicant', ['jobapplicants' => $jobapplicants]);
            } else {
              return redirect()->back()->with('err', "No record found");
            }
          case ($sortStatus == 'Rejected'):
            $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->where('status', 'Rejected')->get();
            if ($jobapplicants->isNotEmpty()) {

              return view('companyapplicant', ['jobapplicants' => $jobapplicants]);
            } else {
              return redirect()->back()->with('err', "No record found");
            }

          case ($sortStatus == 'Accepted'):
            $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->where('status', 'Accepted')->get();


            if ($jobapplicants->isNotEmpty()) {

              return view('companyapplicant', ['jobapplicants' => $jobapplicants]);
            } else {
              return redirect()->back()->with('err', "No record found");
            }

          default:
            $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->orderBy('created_at', 'desc')->paginate(2);
            break;
        }
      } else {


        $jobapplicants = application::with('jobseeker.user.basicBio', 'jobs')->where('company_id', $company_details->id)->orderBy('created_at', 'desc')->paginate(2);
        //  dd($jobapplicants);




        return view('companyapplicant', ['jobapplicants' => $jobapplicants]);
      }
    } else {

      abort(404);
    }
  }

  ///show_create_job

  public function show_create_job()
  {
    $skills = skills::all();
    $locations = locations::all();

    return view('post_job', ['locations' => $locations, "skills" => $skills]);
  }


  //////jobposting///////////////////


  public function jobpost(Request $formdata)
  {
    //  dd( $formdata);
    // enum('Entry Level','Mid Level','Senior Level')

    $validatedinput = $formdata->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'skills' => 'required|array',
      'skills.*' => 'exists:skills,id',
      'proficiency' => 'required|in:Beigneer,Intermediate,Pro',
      'salary' => 'nullable|numeric|',
      'gender' => 'required|in:Male,Female,Any',
      'jobtype' => 'required|in:Full Time,Part Time,Contract,Temporary',
      'location' => 'required|exists:locations,id',
      'positions' => 'required|integer|min:1',
      'agelimit' => 'required|integer|min:18',
      'workinghours' => 'required|string',
      'experiencelevel' => 'required|in:Entry Level,Mid Level,Senior Level',
      'endson' => 'required|date|after:today',

    ]);

    // after validation know create or put data in table
    $id = Auth::id(); //get auth user id 
    $joblistingTable = new joblisting();
    $joblistingTable->user_id = $id;
    $joblistingTable->jobtitle = $formdata->title;

    $joblistingTable->description = strip_tags($formdata->description);
    $joblistingTable->profiency = $formdata->proficiency;
    $joblistingTable->salary = $formdata->salary;
    $joblistingTable->gender = $formdata->gender;
    $joblistingTable->jobtype = $formdata->jobtype;
    $joblistingTable->location_id = $formdata->input('location'); //another way
    $joblistingTable->numberofpositions = $formdata->positions;
    $joblistingTable->agelimit = $formdata->agelimit;
    $joblistingTable->workinghours = $formdata->workinghours;
    $joblistingTable->experiencelevel = $formdata->experiencelevel;
    $joblistingTable->endson = $formdata->endson;
    $joblistingTable->save(); //save it
    //now associate each skill with job posting using inttermediate table
    //FIRST  get all skills from form 
    $skills = $formdata->input('skills', []); // Get the skill IDs from the request, default to an empty array if none
    $joblistingTable->skills()->attach($skills);
    //this job has relation define skills so attach that skills of ids

    return redirect()->back()->with('success', 'Jobposted Successfully');
  }


  //////////////////Delete a job///////////////////////////

  public function DeleteJob($id)
  {

    $job = joblisting::where('user_id', Auth()->id())->where('id', $id);
    $job->delete();
    return redirect()->back()->with('success', '🤠 JobDelete🚮 Successfully');
  }

  ////delete profile
  public function deleteProfile($id)
  {


    $user = User::findOrFail($id);
    $user->delete();
    return  redirect('/')->back()->with('logoutmessage', 'Nice to meet you👊');
  }


  //// jobalter job///////////////


  public function jobalter(Request $request)
  {


    $validatedinput =  $request->validate([
      'title' => 'required|string|max:255',
      'description' => 'required|string',
      'skills' => 'required|array',
      'skills.*' => 'exists:skills,id',
      'proficiency' => 'required|in:Beigneer,Intermediate,Pro',
      'salary' => 'nullable|integer|min:0',
      'gender' => 'required|in:Male,Female,Any',
      'jobtype' => 'required|in:Full Time,Part Time,Contract,Temporary',
      'location' => 'required|exists:locations,id',
      'positions' => 'required|integer|min:1',
      'agelimit' => 'required|integer|min:18',
      'workinghours' => 'required|string',
      'experiencelevel' => 'required|in:Entry Level,Mid Level,Senior Level',
      'endson' => 'required|date|after:today',

    ]);

    $id = Auth::id();
    $joblistingTable = joblisting::where('user_id', Auth()->id())->findOrFail($request->id);

    $joblistingTable->user_id = $id;
    $joblistingTable->jobtitle = $request->title;
    $joblistingTable->description = $request->description;
    $joblistingTable->profiency = $request->proficiency;
    $joblistingTable->salary = $request->salary;
    $joblistingTable->gender = $request->gender;
    $joblistingTable->jobtype = $request->jobtype;
    $joblistingTable->location_id = $request->location;
    $joblistingTable->numberofpositions = $request->positions;
    $joblistingTable->agelimit = $request->agelimit;
    $joblistingTable->workinghours = $request->workinghours;
    $joblistingTable->experiencelevel = $request->experiencelevel;
    $joblistingTable->endson = $request->endson;
    $joblistingTable->save();
    // ddd($joblistingTable);
    $skills = $request->input('skills', []);
    $joblistingTable->skills()->sync($skills);
    // dd($joblistingTable);
    $joblistingTable->refresh();
    return response()->json(['success' => $joblistingTable->load('skills')]);
  }


  ////////////////////deleteApplicant//////////////

  public function applicantDelete($id)
  {

    $applicant = application::find($id);

    $applicant->delete();

    return response()->json(['applicant', 'Delete SuccessFull👍']);
  }


  /////////////////changeStatus////////////////
  public function changeStatus(Request $formdata)
  {
    $id = $formdata->id;
    // dd($id);
    $applicant = application::find($id);
    // dd(  $applicant);
    if ($applicant) {

      $applicant->status = $formdata->status; //make that assigment
      $applicant->save(); //must save it 
      // dd('ok');
      return redirect()->back()->with('success', 'Successfully Updated');
    }
  }

  ///CompanInfo
  public function CompanInfo($id)
  {

    $CompanInfo = companies::where('id', $id)->with('user')->first();
    $companyLocationId = $CompanInfo->location_id;
    $companyLocationName = locations::where('id', $companyLocationId)->pluck('name')->first();

    $companyRating = rating::where('company_id', $id)->average('ratingValue');
    // dd($companyRating);
    $companycount = rating::where('company_id', $id)->count('ratingValue');
    // dd($companycount);


    // // dd($companycount);
    $companyRating = $companyRating ? ceil($companyRating) : 0;
    // // dd( $companyRating); 

    return view('CompanInfo', compact(var_name: ['CompanInfo', 'companyLocationName', 'companyRating', 'companycount']));
  }

  ////companyUpdateProfile

  public function companyUpdateProfile(Request $formdata)
  {

    //remember formdata fields arr conditional as if you are updating

    // dd( $formdata);
    $id = Auth::user()->id;

    $rules = [

      'company_logo' => 'image|max:2048|mimes:png,jpeg,gif,JPG',
      'owner_name' => 'max:50 ',
      'owner_email' => 'unique:users,email,' . $id . 'id',
      'description' => 'nullable',
      'web_url' => 'unique:companies,websiteurl,' . $id . 'user_id',
      'phone_number' => 'unique:companies,websiteurl,' . $id . 'user_id',
      'company_name' => 'unique:companies,websiteurl,' . $id . 'user_id'
    ];

    if ($formdata->role === 'company') {

      //also we want to tell must be unique in company table
      $rules['email'] = [
        'email',
        Rule::unique('companies', 'companyemail')->ignore($id, 'user_id')
      ];

      // hmmm for the weburl uniqueness 



    }
    // dd('oo');
    //   $rules['web_url'] = [
    //     'url',
    //     Rule::unique('companies', 'websiteurl')->ignore($id, 'user_id')
    // ];
    $validator = Validator::make($formdata->all(['owner_email', 'owner_name', 'company_logo', 'email', 'web_url', 'phone_number']), $rules);
    if ($validator->fails()) {
      return back()->withErrors($validator)->withInput();
    }



    //find user whose record in goiing to update

    $user = User::findOrFail(auth()->id());

    $user->name = $formdata->input('owner_name');
    $user->email = $formdata->input('owner_email');
    $user->password = bcrypt($formdata->password);
    $user->save();

    //now find the company

    //that company who want to update his/her info

    $companyUpdated = companies::where('user_id', auth()->id())->first();
    // $picturepath=$formdata->file('company_logo')->getClientOriginalName();
    // dd(  $picturepath);
    // $companyUpdated->picture= $picturepath;

    if ($formdata->file('company_logo')) {
      $picturePath = $formdata->file('company_logo')->store('company_logo', 'public');
      $companyUpdated->picture = $picturePath;
    }

    // $formdata->file('company_logo')->store('company_logo', 'public'); 
    // dd('ok');

    $companyUpdated->companyname = $formdata->company_name;
    $companyUpdated->companyemail = $formdata->email;
    $companyUpdated->phonenumber = $formdata->phone_number;
    $companyUpdated->location_id = $formdata->location;
    $companyUpdated->company_type = $formdata->company_type;
    $companyUpdated->websiteurl = $formdata->web_url;
    $companyUpdated->numberofemployees = $formdata->employees_count;

    if ($formdata->description) {
      $companyUpdated->description = $formdata->description;
    }

    // $companyUpdated->description = $formdata->description;


    $companyUpdated->save();

    return redirect()->back()->with('ProfileUpdated', "update Successfully");
  }

  ///////////////RateCompany//////////////////////////


  public function RateCompany(Request $formdata)
  {

    // dd($formdata);
    $userid = Auth::id();
    $company_id = $formdata->companyid;
    $ratings = $formdata->ratings;

    //check already exist

    $alreadyRated = rating::where('user_id', $userid)->where('company_id', $company_id)->first();
    if ($alreadyRated) {

      return redirect()->back()->with('alreadyRated', 'You already rate a company!');
    }

    $ratingInsert = new rating();

    $ratingInsert->user_id =  $userid;
    $ratingInsert->company_id = $company_id;
    $ratingInsert->ratingValue = $ratings;
    $ratingInsert->save();

    return redirect()->back()->with('Rated', 'Thanks,For Your valuable Feedback😊');
  }


  ////////////////Browse candidate

  public function browse_candidate()
  {


    if (auth()->user()->role == 'company') {


      return view('BrowseCandidate');
    }

    //candidate_Search_filter


  }
  public function candidate_Search_filter(Request $formdata)
  {


    $experience_level =  $formdata->input('experience_level');
 
    $searchCandidate =  $formdata->input('searchCandidate');
    // that search bar
    if ($searchCandidate) {
      $searchResults = BasicBio::whereFullText('profession', $searchCandidate)
        ->orWhereFullText('city_state', $searchCandidate)
        ->get();
 

      //when search by skill
        if($searchResults->isEmpty()){

          $searchResults = skil_rate::whereFullText('skil', $searchCandidate)
          ->get();
        }
      if ($searchResults &&  $experience_level  )   {
         //appply filter
     
        $user_ids=$searchResults->pluck('user_id')->toArray();
          
        $searchResults = $searchResults->whereIn('experience_level', $experience_level);

        if( $searchResults->isEmpty()){

          //it means skill
          $searchResults=BasicBio::whereIn('user_id',$user_ids)->get();
          $searchResults=$searchResults->whereIn('experience_level',$experience_level);
        }
        //when filter results theire
        if ($searchResults) {
         
          $user_ids=$searchResults->pluck('user_id');
          $searchResults=BasicBio::where('user_id',$user_ids)->get();
   
          return view('BrowseCandidate', ['searchResults' => $searchResults]);
        } else {
          //when  no results filter theire
     
          return view('BrowseCandidate', ['searchResults' => $searchResults]);
        }
      }

      //if no exp level
      else {
       
        if ($searchResults->isNotEmpty()) {
          
          //if get a job but w/o filter
          $user_ids=$searchResults->pluck('user_id')->toArray();
         
          $searchResults=BasicBio::whereIn('user_id',$user_ids)->get();
       
          return view('BrowseCandidate', ['searchResults' => $searchResults, []]);
        } else {
        
          session()->flash('err', "No Record Found");

          return view('BrowseCandidate');
        }
      }
    }
  }
}
