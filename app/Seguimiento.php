<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Seguimiento extends Model
{
    protected $table = 'seguimientos';

    protected $fillable = [
        'doctype', 'document', 'hasSymptom', 'symptom', 'email', 'phone',
    ];
}
