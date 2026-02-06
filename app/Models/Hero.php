<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $fillable = [
        'titulo1',
        'titulo2',
        'titulo3',
        'cta',
        'img',
        'video',
        'status',
    ];
}