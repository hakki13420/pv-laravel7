<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable=[
        "grade","created_by",'updated_by'
    ];


    public function users(){
        return $this->hasMany('App\User');
    }

}
