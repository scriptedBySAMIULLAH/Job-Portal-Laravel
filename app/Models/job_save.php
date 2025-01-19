<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class job_save extends Model
{
    use HasFactory;
    protected $table='job_saves';
    protected $fillable = ['job_id','jobseeker_id'];
    
}
