<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnUser extends Model
{
    protected $table = 'vpnusers';

    protected $fillable = [
        'username',
        'password',
        'user_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}