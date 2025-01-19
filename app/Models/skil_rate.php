<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class skil_rate extends Model
{
    use HasFactory;

    protected $table='skil_rates';
    protected $fillable = ['skil'];


    //cvSkill

    public function skillUser(){

        return $this->belongsTo(User::class);
    }
}
