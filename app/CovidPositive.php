<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CovidPositive extends Model
{
    protected $table = 'covid_positive';

    protected $fillable = [
        'covid_id', 'contact_type', 'description', 'symptoms', 'treatment',
        'notes', 
    ];
}
