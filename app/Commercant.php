<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Commercant extends Model
{

    protected $fillable = [
        'type', 'name', 'nrc', 'rais_soc', 'date_n', 'lieux_n', 'adresse_d','commune_id','tel',
        'pere','mere','created_by','updated_by'
    ];


    public function adresse_coms(){
        return $this->hasMany('App\Adresse_com');
    }

    public function activite_coms(){
        return $this->hasMany('App\Activite_com');
    }

    public function commune(){
        return $this->belongsTo('App\Commune');
    }
    public function lieux_n(){
        return $this->belongsTo('App\Commune');
    }

    public function pvs()
    {
        return $this->hasMany('App\Pv');
    }


}
