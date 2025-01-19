<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class companies extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'picture','companyname', 'companyemail','phonenumber','location_id','company_type','websiteurl','numberofemployees','description'];
    public function user()
{
    return $this->belongsTo(User::class);
}



}
