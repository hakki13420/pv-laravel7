<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','grade_id','service_id','brigade_id', 'carte_com','date_carte_com'
        ,'created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function pvs(){
        return $this->hasMany('App\Pv');
    }

    public function grade(){
        return $this->belongsTo('App\Grade','grade_id');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }
    public function brigade(){
        return $this->belongsTo('App\Brigade');
    }
}
