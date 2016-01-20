<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnUsersGroups extends Model
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
    

}