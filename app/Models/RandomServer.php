<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RandomServer extends Model
{
    protected $table = 'randomservers';

    protected $fillable = [
        'user_id',
        'number',
        'requested',
        'used'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}