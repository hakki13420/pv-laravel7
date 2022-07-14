<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brigade extends Model
{
    protected $fillable=['code', 'libelle', 'service_id', 'created_by','updated_by'

    ];

    public function users(){
        return $this->hasMany('App\User');
    }

    public function service(){
        return $this->belongsTo('App\Service');
    }
}
