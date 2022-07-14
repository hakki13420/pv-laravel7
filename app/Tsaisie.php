<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tsaisie extends Model
{
    protected $fillable=[
        "num_saisie","typesaisie_id","pv_id", "category_id", "quantite","sommeDa","created_by",
        "date_saisie","depot_saisie","lieux_saisie",'updated_by'
    ];

    public function pv()
    {
        return $this->belongsTo('App\Pv');
    }

    public function typesaisie()
    {
        return $this->belongsTo('App\Typesaisie','typesaisie_id');
    }

    public function category(){
        return $this->belongsTo("App\Category","category_id");
    }

    public function products()
    {
        return $this->belongsToMany('App\Product')
                    ->withPivot('qte','unite','pu','somme')
                    ->withTimestamps();

    }
}
