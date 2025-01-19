<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Laravel\Scout\Searchable;

class joblisting extends Model
{
    use HasFactory;
    use Searchable; //for scout

    protected $searchableColumns = [



        'jobtitle',
        'companyname',
        'location_id'

    ];

    protected $casts = [
        'endson' => 'datetime:m-d-Y', 
    ];



    //when in laravel we deefine relatioship btw models then we difne this way and return

    //in skill deifne jobs vice versa
    // job belonngs to many skills
    public function skills()
    {

        return $this->BelongsToMany(skills::class, 'joblisting_skill', 'job_id', 'skill_id');
    }
    //one the relationship is defined now we access the skills assocaited with jobs


    //for location
    public function location()
    {

        return $this->belongsTo(locations::class);
    }



    //for user jobsss reverse

    public function User()
    {

        return $this->belongsTo(User::class);
    }


    public function jobsavedby()
    {
        return $this->belongsToMany(jobseekers::class, 'job_saves', 'job_id', 'jobseeker_id');
    }

    public function jobappliedby()
    {


        return $this->belongsToMany(jobseekers::class, 'applications', 'job_id', '
    jobseeker_id');
    }

    public function applications()
    {

        return $this->hasMany(application::class, 'job_id');
    }


    //a filter based on local scope 


    // first define  method

    public function scopeProficency($query, $Proficency)
    {


        // check if empty and also check that its not equal to our default behavior ALL b.c we cant run of defaults

        if ($Proficency && $Proficency !== 'All') {

            //then what add qury 
            return $query->where('profiency', $Proficency);
        }
        return $query; //look see if condition fails if condtion u simply return query so it operate normally


    }


    public function toSearchableArray()
    {

       
        // need to add company name and location name 
        $locationame=optional($this->location)->name;
        // $skill=optional($this->skills)->name;//this is wrong as m skils assocaitd with and ret as array 
        $skill=$this->skills->pluck('name')->toArray();//as job  is assoacited woih m skills so take by name and convert it into array for iterate purposes
        $companyname=optional($this->User->companyinfo)->companyname;
        // dd( $companyname);
        
        //first covert model col into array
        $array = $this->toArray();

       //thia aray is refrencing model column array as all cols beame arrray  which go to algolia
        $array['skill']=$skill;
        $array['locationname']= $locationame;
        $array['companyname']= $companyname;//simply key value pair
        //which col searrching is on

        return [
//this will reuturn to agolia
            'jobtitle' => $this->jobtitle,
            'companyname'=> $companyname,
             'location_id'=>$this->location_id,
             'locationname'=>$locationame,
             'skill'=>$skill
        ];
    }
}
