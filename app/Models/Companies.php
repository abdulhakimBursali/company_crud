<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;

    // protected $table = "companies";


    public function adresses(){
        return $this->hasMany('App\Models\Adresses','company_id','id');
    }
}
