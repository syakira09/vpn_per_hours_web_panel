<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnServer extends Model
{
    protected $table = 'servers';

    protected $fillable = [
        'user_id',
        'zone',
        'token',
        'random'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

    public function users()
    {
        return $this->belongsToMany('App\Models\VpnGroup','serversvpngroups')->withTimestamps();
    }

}