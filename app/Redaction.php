<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Redaction extends Model
{

    protected $fillable = [
        'redaction','pv_id','created_by','updated_by'
    ];



    public function pv(){
        return $this->belongsTo('App\Pv');
    }


}
