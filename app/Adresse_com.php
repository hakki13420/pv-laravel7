<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adresse_com extends Model
{
    protected $fillable = [
        'adresse_com', 'commercant_id','created_by','updated_by'
    ];


    public function commercant(){
        return $this->belongsTo('App\commercant');
    }
}
