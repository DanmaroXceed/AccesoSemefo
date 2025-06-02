<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class registro extends Model
{
    protected $fillable = [
        'ip',
        'nombre',
        'pape',
        'sape',
        'curp',
        'tel',
        'email',
        'acceso',
    ];
}
