<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable 
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name', 'email', 'password', 'role'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function jobseeker()
{
    return $this->hasOne(jobseekers::class);
}



// get comppany info but ! also for index cards
public function companyinfo()
{
    return $this->hasOne(companies::class,"user_id");
}
/// for job  and user in order to get CN


public function job()
{
    return $this->hasMany(joblisting::class,"user_id");
}


public function messages(){



   return $this->hasMany(contactUs::class,'user_id');
}


////////////////////////////////////////////////cv////////////////////////////////////////////    

    // basic bio
    public function basicBio(){


        return $this->hasOne(BasicBio::class,'user_id');
    }


     // cvSkill
     public function cvSkill(){


        return $this->hasMany(skil_rate::class,'user_id');
    }

    // WorkHistory

    public function WorkHistory(){


        return $this->hasMany(Work_History::class,'user_id');
    }


    // education

    public function education(){


        return $this->hasMany(education::class,'user_id');
    }

    // projects

    public function projects(){


        return $this->hasMany(Projects::class,'user_id');
    }

    










}
