<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Configuration extends Model
{


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ministere', 'organisme', 'slogan', 'adresse', 'email', 'tel', 'fax', 'site', 'created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
}
