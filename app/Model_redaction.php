<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Model_redaction extends Model
{

    protected $fillable = [
        'model', 'title', 'infraction_id','created_by','updated_by'
    ];



    public function infraction(){
        return $this->belongsTo('App\Infraction');
    }


}
