<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name',
        'number',
        'email',
        'address',
        'status'
    ];

    protected $casts = [
        'status' => 'boolean'
    ];
}
