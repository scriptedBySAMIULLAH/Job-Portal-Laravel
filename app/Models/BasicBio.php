<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasicBio extends Model
{
    use HasFactory;

    protected $table='basic_bios';
    protected $fillable = ['name', 'surname', 'profession', 'city_state' ,'phone', 'email', 'yourself'];
    //user 

    public function basicbioUser(){

        return $this->belongsTo(User::class);
    }

}
