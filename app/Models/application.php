<?php

namespace App\Models;

use App\Http\Controllers\jobseeker;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application extends Model
{
    use HasFactory;
    protected $table = 'applications'; 
    protected $fillable = ['job_id', 'jobseeker_id', 'status', 'cv'];


    public function jobs(){

        return $this->belongsTo(joblisting::class,'job_id');
    }
    public function jobseeker(){

        return $this->belongsTo(jobseekers::class,'jobseeker_id');
    }
}
