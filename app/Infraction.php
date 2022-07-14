<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Infraction extends Model
{
    protected $fillable = [
        'code', 'libelle','libelle_fr', 'lois', 'articles', 'lois_p', 'articles_p',
        'autres_mesures','amande', 'created_by','updated_by'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function model_redactions()
    {
        return $this->hasMany('App\Model_redaction');
    }

    public function pvs()
    {
        return $this->belongsToMany('App\Pv');
    }

}
