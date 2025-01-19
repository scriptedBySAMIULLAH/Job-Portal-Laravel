<?php

namespace App\Models;

use App\Models\joblisting;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class locations extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    protected $table='locations';   
    public function companies()
    {
        return $this->hasMany(companies::class);
        // you are in location so one location belongs to hasMany with companies
    }

  

    // for job

    public function jobs(){

        return $this->hasMany(joblisting::class);
    }
}
