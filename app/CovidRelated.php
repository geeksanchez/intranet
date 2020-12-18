<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidRelated extends Model
{
    protected $table = 'covid_related';

    protected $fillable = [
        'covid_id', 'employee_id', 
    ];

}
