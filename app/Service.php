<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Service extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'service', 'adresse', 'contact','created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [

    ];


    public function communes(){
        return $this->hasMany('App\Commune','service_id');
    }

    public function users(){
        return $this->hasMany('App\User');
    }
    public function brigades(){
        return $this->hasMany('App\Brigade');
    }
    public function pvs(){
        return $this->hasMany('App\Pv');
    }

}
