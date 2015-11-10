<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
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