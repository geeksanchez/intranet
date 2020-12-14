<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidFollow extends Model
{
    protected $table = 'covid_follow';

    protected $fillable = [
        'covid_id', 'disability', 'disability_date', 'return_date', 'diagnosis',
        'notes', 'user_id', 
    ];
}
