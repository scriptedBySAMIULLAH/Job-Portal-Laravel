<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skills extends Model
{
    use HasFactory;
    protected $table ='skills';

    public function joblisting(){

        return $this->belongsToMany(joblisting::class,'joblisting_skill','skill_id','job_id');
    }
}
