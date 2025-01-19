<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable;

class jobseekers extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'jobseekername', 'picture', 'CV'];
    protected $table = 'jobseekers';

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function saves()
    {
        return $this->belongsToMany(joblisting::class,'job_saves','jobseeker_id','job_id');     
    }

    //for apply

    public function apply(){

        return $this->belongsToMany(joblisting::class,'applications','jobseeker_id','job_id');
    }
    public function applications(){
        return $this->hasMany(application::class,'jobseeker_id');

    }

  
}
