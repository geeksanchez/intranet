<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $table = 'employee';

    protected $fillable = [
        'doctype', 'document', 'fullname',  'birthdate', 'gender', 'phone',
        'address', 'city',
    ];
}
