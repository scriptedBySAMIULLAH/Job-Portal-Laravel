<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    use HasFactory;
    protected $table='projects';


    // projects


    public function projectsUser(){


        return $this->belongsTo(User::class);
    }
    
}
