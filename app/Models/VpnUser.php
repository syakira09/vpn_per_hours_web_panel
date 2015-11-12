<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnUser extends Model
{
    protected $table = 'vpnusers';

    protected $fillable = [
        'name',
        'password',
        'user_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}