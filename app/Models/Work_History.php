<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work_History extends Model
{
    use HasFactory;
    protected $table='work__histories';


    // WorkHistory

    public function workhistoryUser(){


        return $this->belongsTo(User::class);
    }
}
