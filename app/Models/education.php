<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;
    protected $table='education';

    // education

    public function educationUser(){


        return $this->belongsTo(User::class);
    }
}
