<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnServer extends Model
{
    protected $table = 'servers';

    protected $fillable = [
        'user_id',
        'zone',
        'token'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}