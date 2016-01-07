<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VpnGroup extends Model
{
    protected $table = 'vpngroups';

    protected $fillable = [
        'name'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }
}