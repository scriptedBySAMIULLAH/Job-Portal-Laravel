<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contactUs extends Model
{
    use HasFactory;

    protected $table='user_contact_us';


    public function Usermessage(){


       return $this->belongsTo(User::class,'user_id');
    }
}
