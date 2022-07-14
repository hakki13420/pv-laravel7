<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    protected $fillable = [
        'code', 'libelle', 'libelle_fr','created_by','updated_by'
    ];

    public function activite_coms(){
        return $this->hasMany('App\Activite_com');
    }
}
