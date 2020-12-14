<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidState extends Model
{
    protected $table = 'covid_state';

    protected $fillable = [
        'name',
    ];
}
