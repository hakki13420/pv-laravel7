<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pv extends Model
{
    protected $fillable=[
        "num_pv","date_pv","hour_pv","min_pv","commercant_id","adresse_com_id","activite_com_id","user1",
        "user2","user3","service_id","date_constat","num_conv","date_conv","redaction",
        "amande","commentaires", "signature", "hasSaisie" , "created_by",'updated_by'
    ];

    public function commercant(){
        return $this->belongsTo('App\Commercant');
    }

    public function adresse_com(){
        return $this->belongsTo('App\Adresse_com');
    }

    public function activite_com(){
        return $this->belongsTo('App\Activite_com');
    }
    public function user1(){
        return $this->belongsTo('App\User','user1');
    }
    public function user2(){
        return $this->belongsTo('App\User','user2');
    }
    public function user3(){
        return $this->belongsTo('App\User','user3');
    }

    public function service(){
        return $this->belongsTo('App\Service','service_id');
    }

    public function infractions(){
        return $this->belongsToMany('App\Infraction');
    }


    public function tsaisie(){
        return $this->hasOne('App\Tsaisie');
    }

}
