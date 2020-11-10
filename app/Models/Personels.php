<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personels extends Model
{
    use HasFactory;

    public function company(){
        return $this->hasOne('App\Models\Companies','id','company_id');
    }
}
