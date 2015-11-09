<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = [
        'user_id',
        'zone',
        'true_zone',
        'provider'
    ];

}