<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pqrs extends Model
{
    protected $table = 'pqrs';

    protected $fillable = [
        'doctype', 'document', 'username',  'email', 'phone', 'cellphone',
        'insurer', 'branch', 'service', 'classification', 'pqrstype',
        'notes', 'filledby', 'legal', 'active', 'feedback',
    ];
}
