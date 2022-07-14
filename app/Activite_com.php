<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activite_com extends Model
{
    protected $fillable = [
        'activite_id', 'libelle', 'commercant_id','created_by','updated_by'
    ];


    public function commercant(){
        return $this->belongsTo('App\Commercant');
    }

    public function activite(){
        return $this->belongsTo('App\Activite');
    }
}
