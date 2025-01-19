<?php

namespace App\Http\Controllers;

use App\Models\contactUs;
use App\Models\joblisting;
use App\Models\skills;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Exists;

class Admin extends Controller
{
    public function AdminIndex()
    {
        $users = User::paginate(4);
        // dd($users);

        return view(
            'Admin.Admin',
            ['users' => $users]
        );
    }


    public function DeleteUser($id, $type)
    {

    
            $userTobeDelete = User::findOrFail($id);
            $userTobeDelete->delete();
        return redirect()->back()->with('UserDeleted', 'UserDeleted Successfully');
    }


    public function Block_Unblock_User($id){
        $userStatus = User::findOrFail($id);
     
        $Status = $userStatus->status;
      
        if ($Status == 'Block') {
            // dd(   '$Status');
            $userStatus->status = 'Active';
            $userStatus->save();

        }
        
        else{
            // dd(   $userStatus->status);

            $userStatus->status= "Block";
            $userStatus->save();

        }
        return redirect()->back()->with('success', 'Updated');


    }


    public function adminjobs()
    {

        $jobs = joblisting::paginate(4);
        return view('Admin.jobs', [


            'jobs' => $jobs
        ]);
    }


    public function AdminDeleteJob($id)
    {
        $JobTobeDelete = joblisting::findOrFail($id);

        $JobTobeDelete->delete();
        return redirect()->back()->with('JobDeleted', 'JObDeleted Successfully');
    }


    public function Search(Request $formdata)
    {

        // dd($formdata);
        if ($formdata) {



            $searchquery = $formdata->input('searchquery');
            $searchuser = $formdata->input('searchuser');



            if ($formdata->role === 'searchqueryJob') {

                $jobs = joblisting::where('jobtitle', 'LIKE', "%{$searchquery}%")

                    ->paginate(5);

                return view('Admin.jobs', [


                    'jobs' => $jobs
                ]);
            } else {


                $users = User::where('name', 'LIKE', "{$searchuser}")
                    ->orWhere('role', 'LIKE', "{$searchuser}")
                    ->paginate(5);
                return view(
                    'Admin.Admin',
                    ['users' => $users]

                );
            }

            // dd($searchquery);


        }
    }


    public function Admin_messages_ContactUs()
    {

        $allMessages = contactUs::with('Usermessage')->get(); //a collection return
        return view('Admin.messages', compact(['allMessages']));
    }

    public function AdminDeleteMessage($id)
    {


        $record = contactUs::findOrFail($id);
        $record->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }



    public function add_skill(Request $fromdata)
    {
        // $allskill=skills::get();
        // dd( $allskill);
        $skillArray = $fromdata->input('skills');
        // dd( $skillArray);
        $skillArrayCount = count($skillArray);
        $allskill = skills::all();
        if (!(DB::table('skills')->whereIn('name', $skillArray)->exists())) {

            for ($i = 0; $i < $skillArrayCount; $i++) {


                $skill = new skills();

                $skill->name = $skillArray[$i];

                $skill->save();
            }
        } else {

            return redirect()->back()->with("err", "some of value already theire");
        }


        return redirect()->back()->with("success", "Added✔");
    }



    public function filter(Request $formdata)
    {
        $users=User::where('is_verified',$formdata->verifiedChk)->paginate(4);
        return view('Admin.Admin',compact('users'));
        
    }
}
