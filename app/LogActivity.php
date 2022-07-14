<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'id', 'title', 'details', 'action', 'method', 'table', 'user', 'url', 'ip', 'agent'
    ];
}
