<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable=['category','created_by','updated_by'];


    public function products()
    {
        return $this->hasMany('App\Product');
    }

    public function tsaisies()
    {
        return $this->hasMany('App\Tsaisie');

    }

}
