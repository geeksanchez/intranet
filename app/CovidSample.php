<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidSample extends Model
{
    protected $table = 'covid_sample';

    protected $fillable = [
        'covid_id', 'sample_date', 'result',
    ];
}
