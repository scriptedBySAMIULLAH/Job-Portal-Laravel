<?php

namespace App\Http\Controllers;

use App\Models\education;
use App\Models\Projects;
use App\Models\skil_rate;
use Illuminate\Http\Request;
use App\Models\BasicBio;
use App\Models\User;
use App\Models\Work_History;
use Doctrine\DBAL\Query\From;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use SebastianBergmann\CodeUnit\FunctionUnit;
use Illuminate\Support\Arr;

class cv extends Controller
{

   public function cv_validator(Request $formdata, $inspect)
   {
      // $oldimage= BasicBio::where('user_id',  auth()->id())->first();
      // $id=$formdata->user;
      // dd($formdata);

      //step-1//

      $rules = [
         'img' => 'nullable|image|mimes:png,jpeg|max:5120',
         'name' => 'nullable|string|min:5',
         'surname' => 'required|string|min:5',
         'profession' => 'nullable|string|max:50',
         'city_state' => 'nullable|string|max:30',
         'phone' => 'nullable|string|max:14',
         'email' => 'nullable|email',
         'yourself' => 'nullable|string',
         'experience_level' => 'nullable|in:entry_level,junior,mid_level,senior',
         // 'linkedinprofile' => 'nullable|string',
         // 'websiteportfolio' => 'nullable|string'
      ];




      $validator = Validator::make($formdata->all('img', 'name', 'surname', 'profession', 'city_state', 'phone', 'email', 'yourself','experience_level'), $rules);

      if ($validator->fails()) {
         return back()->withErrors($validator)->withInput();
      }
    
      //step-2//
      $rules = [
         'skill' => 'required|array',
         'skill.*' => 'string|max:255'
      ];

      $validator = Validator::make($formdata->all('skill'), $rules);

      if ($validator->fails()) {
         session()->flash('step-2');
         return back()->withErrors($validator)->withInput();
      }

      //step-3//
      $rules = [

         'JobTitle' => 'array|nullable',
         'JobTitle.*' => 'string|nullable|max:100',
         'Employer' => 'array|nullable',
         'Employer.*' => 'string|nullable|max:100',
         'Location' => 'array|nullable',
         'Location.*' => 'string|nullable|max:100',
      ];

      $validator = Validator::make($formdata->all('JobTitle', 'Employer', 'Location'), $rules);

      if ($validator->fails()) {

         session()->flash('step-3');
         return back()->withErrors($validator)->withInput();
      }

      //step-4
      $rules = [

         'schName' => 'array|nullable',
         'schName.*' => 'string|nullable|max:100',
         'schlLoc' => 'array|nullable',
         'schlLoc.*' => 'string|nullable|max:100',
         'fieldstudy' => 'array|nullable',
         'fieldstudy.*' => 'string|nullable|max:100',
      ];

      $validator = Validator::make($formdata->all('schName', 'schlLoc', 'fieldstudy'), $rules);

      if ($validator->fails()) {

         session()->flash('step-4');
         return back()->withErrors($validator)->withInput();
      }


      //step-5
      $rules = [

         'techUse' => 'array|nullable',
         'techUse.*' => 'string|nullable|max:100',
         'projects' => 'array|nullable',
         'projects.*' => 'string|nullable|max:500',

      ];

      $validator = Validator::make($formdata->all('techUse', 'projects'), $rules);
    
      if ($validator->fails()) {

         session()->flash('step-5');
         return back()->withErrors($validator)->withInput();
      }


      if ($inspect == 'dataTakeForm') {
         $this->cvHandel($formdata);
         return redirect()->route('jobseekerDashboard')->with('success',"Success✅");
      } else {

         $this->updateCV($formdata);
         return redirect()->back()->with('success', "Updated");
      }


   }





   // data taking
   public function cvHandel(Request $formdata)
   {
      $basicBio = new BasicBio();
      $basicBio->user_id = auth()->id();
      if ($formdata->hasFile('img')) {
         $image_name = time() . '_' . $formdata->file('img')->getClientOriginalName(); //unique name of img if two users got same img then query is going to crazy
         $basicBio->img = $image_name; //store in db a name only
         $formdata->file('img')->storeAs('cv_images', $image_name, 'public'); //that file with that name is stored on server instead server give it a unique name as its own

      }
      $basicBio->name = $formdata->input('name');
      $basicBio->surname = $formdata->input('surname');
      $basicBio->profession = $formdata->input('profession');
      $basicBio->experience_level = $formdata->input('experience_level');
      $basicBio->linkedinprofile = $formdata->input('linkedinprofile');
      $basicBio->websiteportfolio = $formdata->input('websiteportfolio');
      $basicBio->city_state = $formdata->input('city_state');
      $basicBio->phone = $formdata->input('phone');
      $basicBio->email = $formdata->input('email');
      $basicBio->yourself = $formdata->input('yourself');
      $basicBio->save();
      // basic bio ends

      //////////////////////////////////////skill section//////////////////////////////////////////////////

      $skill_Array = $formdata->input('skill');
      $rate_value_Array = $formdata->input('rate');
      $arraySkillCount = count($skill_Array);

      for ($i = 0; $i < $arraySkillCount; $i++) {
         $skill_rate = new skil_rate();

         $skill_rate->user_id = auth()->id();

         $skill_rate->skil = $skill_Array[$i];

         $skill_rate->rate_value = $rate_value_Array[$i];

         $skill_rate->save();
      }



      // skill section ends



      /////////////////////////WorkHistory//////////////////////////////////////////////////


      //count//
      $array = $formdata->input('JobTitle'); //for counting purpose
      $count = count($array); // sub co count na krany as general count ek kr kr lyn supposed kr ky ky utni secctions user ny add kiya hyn  gay
      //count ends//

      $JobTitleArray = $formdata->input('JobTitle');
      $EmployerArray = $formdata->input('Employer');
      $LocationArray = $formdata->input('Location');
      $stdmonthsWArray = $formdata->input('stdmonthsW');
      $stdyearsWArray = $formdata->input('stdyearsW');
      $endmonthsWArray = $formdata->input('endmonthsW');
      $endyearsWArray = $formdata->input('endyearsW');


      for ($i = 0; $i < $count; $i++) {
         $Work_History = new Work_History();

         $Work_History->user_id = auth()->id();

         $Work_History->JobTitle = $JobTitleArray[$i];

         $Work_History->Employer = $EmployerArray[$i];

         $Work_History->Location = $LocationArray[$i];

         $Work_History->stdmonthsW = $stdmonthsWArray[$i];

         $Work_History->stdyearsW = $stdyearsWArray[$i];

         $Work_History->endmonthsW = $endmonthsWArray[$i];


         $Work_History->endyearsW = $endyearsWArray[$i];

         $Work_History->save();

         // dd( $array[ $i]);
      }


      // Work History section ends

      //////////////////////////// your education/////////////////////////////////////////////



      //count//
      $arr = $formdata->input('schName');
      $cnt = count($arr);
      //count ends//

      $schNameArray =               $formdata->input('schName');
      $schlLocArray =               $formdata->input('schlLoc');
      $fieldstudyArray =            $formdata->input('fieldstudy');
      $DegreeArray =                $formdata->input('Degree');
      $GraduationDateYearsArray =   $formdata->input('GraduationDateYears');
      $GraduationDatemonthsArray =  $formdata->input('GraduationDatemonths');


      for ($i = 0; $i < $cnt; $i++) {
         $education = new education();
         $education->user_id = auth()->id();

         $education->schName =                  $schNameArray[$i];

         $education->schlLoc =                  $schlLocArray[$i];

         $education->fieldstudy =               $fieldstudyArray[$i];

         $education->Degree =                  $DegreeArray[$i];

         $education->GraduationDateYears =     $GraduationDateYearsArray[$i];

         $education->GraduationDatemonths =     $GraduationDatemonthsArray[$i];

         $education->save();
      }


      // education section ends

      ////////////////////////////////// projects/////////////////////////////////////////////////


      $projectVar = $formdata->input('projects');

      $projectCount = count($projectVar);

      $projectArray = $formdata->input('projects');

      $techUseArray = $formdata->input('techUse');
      for ($i = 0; $i < $projectCount; $i++) {
         $project = new Projects();

         $project->user_id = auth()->id();

         $project->projects =  $projectArray[$i];

         $project->techUse =  $techUseArray[$i];


         $project->save();
      }


      return redirect()->route('Layout-Selection_view');

      // project section ends
      //Display a cv to user immedaitley after making it 

      // 1.basicBio
      // 2.Skill
      // 3.workHistory
      // 4.education
      // 5.Projects


      //basicBio


   }




   public function cv_Preview($layout)
   {

      if (BasicBio::where('user_id', auth()->id())->exists()) {
         if (auth()->user()->role === 'jobseeker') {
            $userBio = User::with('basicBio')->where('id', auth()->id())->first();

            $userSkill = User::with('cvSkill')->where('id', auth()->id())->first();

            $userworkHistory = User::with('WorkHistory')->where('id', auth()->id())->first();

            $userEducation = User::with('education')->where('id', auth()->id())->first();

            $userProjects = User::with('projects')->findOrFail(auth()->id());


            // return redirect()->route('jobseekerDashboard');

            if ($layout === '1Column') {


               return view('visualcv', [
                  'userBio' => $userBio,

                  'userSkill' => $userSkill->cvSkill,

                  'userworkHistory' => $userworkHistory->WorkHistory,

                  'userEducation' => $userEducation->education,

                  'userProjects' => $userProjects->projects
               ]);
            } else {

               return view('TwoColCV', [
                  'userBio' => $userBio,

                  'userSkill' => $userSkill->cvSkill,

                  'userworkHistory' => $userworkHistory->WorkHistory,

                  'userEducation' => $userEducation->education,

                  'userProjects' => $userProjects->projects
               ]);
            }
         } else {

            abort(404);
         }
      } else {

         session()->flash('err', 'Please try to make Cv first');
         return view('cvDataTake');
      }
   }



   public function showEditForm()
   {
      
        $userExist= BasicBio::where('user_id',auth()->id())->exists();

      if($userExist){
      $userBio = User::with('basicBio')->where('id', auth()->id())->first();

      $userSkill = User::with('cvSkill')->where('id', auth()->id())->first();

      $userworkHistory = User::with('WorkHistory')->where('id', auth()->id())->first();

      $userEducation = User::with('education')->where('id', auth()->id())->first();

      $userProjects = User::with('projects')->findOrFail(auth()->id());

      return view('editCV', [
         'userBio' => $userBio->basicBio,

         'userSkill' => $userSkill->cvSkill,

         'userworkHistory' => $userworkHistory->WorkHistory,

         'userEducation' => $userEducation->education,

         'userProjects' => $userProjects->projects
      ]);
   }

   else{
      session()->flash('err', 'Please try to make Cv first');
      return view('cvDataTake');
   }
   }

   public function updateCV(Request $formdata)
   {


      /////////////////basic bio
      $id = $formdata->input('user');
      $exist = BasicBio::where('user_id', $id)->first();
      if ($exist) {

         // $exist->user_id=auth()->id();

         if ($formdata->hasFile('img')) {

            $oldimage = $exist->img;
            if ($oldimage) {
               //del prev
               Storage::delete('public/cv_images/' . $oldimage);
            }
            $image_name = time() . '_' . $formdata->file('img')->getClientOriginalName();
            $exist->img = $image_name;
            $formdata->file('img')->storeAs('cv_images', $image_name, 'public');
         }

         $exist->update([
            'name' => $formdata->input('name'),
            'surname' => $formdata->input('surname'),
            'profession' => $formdata->input('profession'),
            'experience_level' => $formdata->input('experience_level'),
            'linkedinprofile' => $formdata->input('linkedinprofile'),
            'websiteportfolio' => $formdata->input('websiteportfolio'),
            'city_state' => $formdata->input('city_state'),
            'phone' => $formdata->input('phone'),
            'email' => $formdata->input('email'),
            'yourself' => $formdata->input('yourself')
         ]);
      }

      /////////////////////////skills /////////////////////////


      $exist = skil_rate::where('user_id', $id)->first();
      $ids = skil_rate::where('user_id', $id)->pluck('id');
      $ids = $ids->toArray();
      // dd($ids);
      if ($exist) {

         $skills = $formdata->input('skill');
         $rate_values = $formdata->input('rate');
         $prevSkillsCount =  $formdata->input('skillval');
         // dd(  $skills);

         //add new one
         $cnt = count($skills);

         $limit = $cnt - $prevSkillsCount;

         if ($limit != 0) {

            $newskills = array_slice($skills, $prevSkillsCount, $limit);
            $newratings = array_slice($rate_values, $prevSkillsCount, $limit);

            for ($i = 0; $i < count($newskills); $i++) {
               $skill_rate = new skil_rate();

               $skill_rate->user_id = auth()->id();

               $skill_rate->skil = $newskills[$i]??null;

               $skill_rate->rate_value = $newratings[$i]??null;

               $skill_rate->save();
            }
         }

         //add new one ends


         //add olds
         for ($i = 0; $i < $prevSkillsCount; $i++) {

            $oldskills[] = $skills[$i];
            $oldraatings[] = $rate_values[$i];
         }


         foreach ($ids as  $key => $value) {


            skil_rate::where('id', $value)->update([
               'skil' => $oldskills[$key],
               'rate_value' => $oldraatings[$key]
            ]);
         }

         // dd('rer');
      }


      /////////////////////////////Work History

      $exist = Work_History::where('user_id', $id)->first();

      $ids = Work_History::where('user_id', $id)->pluck('id');

      $ids = $ids->toArray();

      $prevWorkHistoryValue = $formdata->input('WorkHistoryValue');

      //new
      $Array = $formdata->input('JobTitle');
      $JobTitleArray = $formdata->input('JobTitle');
      $EmployerArray = $formdata->input('Employer');
      $LocationArray = $formdata->input('Location');
      $stdmonthsWArray = $formdata->input('stdmonthsW');
      $stdyearsWArray = $formdata->input('stdyearsW');
      $endmonthsWArray = $formdata->input('endmonthsW');
      $endyearsWArray = $formdata->input('endyearsW');
      $count = count($Array);
      $limit = $count - $prevWorkHistoryValue;


      if ($limit != 0) {

         $newJobTitleArray = array_slice($JobTitleArray, $prevWorkHistoryValue, $limit);
         $newEmployerArray = array_slice($EmployerArray, $prevWorkHistoryValue, $limit);
         $newLocationArray = array_slice($LocationArray, $prevWorkHistoryValue, $limit);
         $newstdmonthsWArray = array_slice($stdmonthsWArray, $prevWorkHistoryValue, $limit);
         $newstdyearsWArray = array_slice($stdyearsWArray, $prevWorkHistoryValue, $limit);
         $newendmonthsWArray = array_slice($endmonthsWArray, $prevWorkHistoryValue, $limit);
         $newendyearsWArray = array_slice($endyearsWArray, $prevWorkHistoryValue, $limit);

         for ($i = 0; $i < count($newJobTitleArray); $i++) {
            $Work_History = new Work_History();
            $Work_History->user_id = auth()->id();

            $Work_History->JobTitle = isset($newJobTitleArray[$i])?$newJobTitleArray[$i]:null;
            $Work_History->Employer = $newEmployerArray[$i]??null;
            $Work_History->Location = $newLocationArray[$i]??null;
            $Work_History->stdmonthsW = $newstdmonthsWArray[$i]??null;
            $Work_History->stdyearsW = $newstdyearsWArray[$i]??null;
            $Work_History->endmonthsW = $newendmonthsWArray[$i]??null;
            $Work_History->endyearsW = $newendyearsWArray[$i]??null;

            $Work_History->save();
         }
      }
      //old

      // dd( $ids[0] );
      if ($exist) {
         for ($i = 0; $i < $prevWorkHistoryValue; $i++) {
            Work_History::where('id', $ids[$i])->update([
               'JobTitle' => $JobTitleArray[$i],
               'Employer' => $EmployerArray[$i],
               'Location' => $LocationArray[$i],
               'stdmonthsW' =>  $stdmonthsWArray[$i],
               'endmonthsW' =>  $endmonthsWArray[$i],
               'stdyearsW' => $stdyearsWArray[$i],
               'endyearsW' =>    $endyearsWArray[$i],
            ]);
         }
      }

      /////////////////////////edu
      $ids = education::where('user_id', $id)->pluck('id');
      $ids = $ids->toArray();
      $Array = $formdata->input('schName');

      $exist = education::where('user_id', $id)->first();
      $preveducationValue = $formdata->input('educationValue');
      $schNameArray =               $formdata->input('schName');
      $schlLocArray =               $formdata->input('schlLoc');
      $fieldstudyArray =            $formdata->input('fieldstudy');
      $DegreeArray =                $formdata->input('Degree');
      $GraduationDateYearsArray =   $formdata->input('GraduationDateYears');
      $GraduationDatemonthsArray =  $formdata->input('GraduationDatemonths');
      $count = count($Array);
      $limit = $count - $preveducationValue;
      // dd($schNameArray);
      if ($limit != 0) {

         $newschNameArray = array_slice($schNameArray, $preveducationValue, $limit);
         $newschlLocArray = array_slice($schlLocArray, $preveducationValue, $limit);
         $newfieldstudyArray = array_slice($fieldstudyArray, $preveducationValue, $limit);
         $newDegreeArray = array_slice($DegreeArray, $preveducationValue, $limit);
         $newGraduationDateYearsArray = array_slice($GraduationDateYearsArray, $preveducationValue, $limit);
         $newGraduationDatemonthsArray = array_slice($GraduationDatemonthsArray, $preveducationValue, $limit);

         // dd($newGraduationDateYearsArray);
         for ($i = 0; $i < count($newschNameArray); $i++) {
            $education = new education();
            $education->user_id = auth()->id();

            if ($newschNameArray) {

               $education->schName = $newschNameArray[$i];
            }

            if ($newschNameArray) {
               $education->schlLoc = $newschlLocArray[$i];
            }

            if ($newfieldstudyArray) {

               $education->fieldstudy = $newfieldstudyArray[$i];
            }
            if ($newDegreeArray) {

               $education->Degree = $newDegreeArray[$i];
            }

            if ($newGraduationDateYearsArray) {
               $education->GraduationDateYears = $newGraduationDateYearsArray[$i];
            }



            if ($newGraduationDatemonthsArray) {

               $education->GraduationDatemonths = $newGraduationDatemonthsArray[$i];
            }


            $education->save();
         }
      }
      if ($exist) {
         for ($i = 0; $i < $preveducationValue; $i++) {
            education::where('id', $ids[$i])->update([
               'schName' => $schNameArray[$i],
               'schlLoc' => $schlLocArray[$i],
               'fieldstudy' => $fieldstudyArray[$i],
               'Degree' =>  $DegreeArray[$i],
               'GraduationDateYears' =>  $GraduationDateYearsArray[$i],
               'GraduationDatemonths' => $GraduationDatemonthsArray[$i]

            ]);
         }
      }



      ///////projects
      $ids = Projects::where('user_id', $id)->pluck('id');
      $ids = $ids->toArray();
      $Array = $formdata->input('projects');

      $exist = Projects::where('user_id', $id)->first();
      $prevProjectsValue = $formdata->input('ProjectsValue');
      $techUseArray = $formdata->input('techUse');
      $projectsArray =  $formdata->input('projects');

      $count = count($Array);
      $limit = $count - $prevProjectsValue;

      if ($limit != 0) {

         $newtechUseArray = array_slice($techUseArray, $prevProjectsValue, $limit);
         $newprojectsArray = array_slice($projectsArray, $prevProjectsValue, $limit);


         // dd(  $prevProjectsValue);
         for ($i = 0; $i < count($newtechUseArray); $i++) {
            $Projects = new Projects();
            $Projects->user_id = auth()->id();

            if ($newtechUseArray) {

               $Projects->techUse = $newtechUseArray[$i];
            }

            if ($newprojectsArray) {

               $Projects->projects = $newprojectsArray[$i];
            }


            $Projects->save();
         }
      }

      //old
      if ($exist) {
         for ($i = 0; $i < $prevProjectsValue; $i++) {
            Projects::where('id', $ids[$i])->update([
               'techUse' => $techUseArray[$i],
               'projects' => $projectsArray[$i]


            ]);
         }
      }
   }



   public function browseCandidateCompany($id){


      if (BasicBio::where('user_id', $id)->exists()) {

         $userBio = User::with('basicBio')->where('id', $id)->first();

         $userSkill = User::with('cvSkill')->where('id', $id)->first();

         $userworkHistory = User::with('WorkHistory')->where('id', $id)->first();

         $userEducation = User::with('education')->where('id', $id)->first();

         $userProjects = User::with('projects')->findOrFail($id);

         return view('TwoColCV', [
            'userBio' => $userBio,

            'userSkill' => $userSkill->cvSkill,

            'userworkHistory' => $userworkHistory->WorkHistory,

            'userEducation' => $userEducation->education,

            'userProjects' => $userProjects->projects
         ]);
      }





   }
}
