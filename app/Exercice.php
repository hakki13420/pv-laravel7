<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exercice extends Model
{
    protected $fillable=['year','libelle','created_by','updated_by'];
}
