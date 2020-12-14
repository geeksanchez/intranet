<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Covid extends Model
{
    protected $table = 'covid';

    protected $fillable = [
        'employee_id', 'temperature', 'symptoms', 'close_contact', 'covid_state_id', 
    ];
}
