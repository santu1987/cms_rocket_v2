<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Footer extends Model
{
    protected $fillable = [
        'title1',
        'title2',
        'title3',
        'email',
        'rif',
        'phone_number',
        'status',
    ];
}