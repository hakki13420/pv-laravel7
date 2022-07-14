<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Typesaisie extends Model
{
    protected $fillable=["libelle","created_by",'updated_by'];

    public function tsaisies()
    {
        return $this->hasMany('Tsaisie::class');
    }
}
