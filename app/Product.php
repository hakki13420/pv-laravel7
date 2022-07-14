<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable=["libelle","category_id","created_by",'updated_by'];


    public function category()
    {
        return $this->BelongsTo('App\Category');
    }

    public function tsaisies()
    {
        return $this->belongsToMany('App\Tsaisie')
                    ->withPivot('qte','unite','pu','somme')
                    ->withTimestamps();
    }
}
