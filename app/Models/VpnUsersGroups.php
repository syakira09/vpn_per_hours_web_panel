<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnUser extends Model
{
    protected $table = 'vpnusersgroups';

    protected $fillable = [
        'vpnuser_id',
        'vpngroup_id',
        'user_id'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function vpnusersgroups()
    {
        return $this->hasMany('App\Models\VpnUsersGroups');
    }

}