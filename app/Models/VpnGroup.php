<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnGroup extends Model
{
    protected $table = 'vpngroups';

    protected $fillable = [
        'name',
        'user_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\VpnUser','vpnusersgroups')->withTimestamps();
    }

}