<?php


namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class OldVpnServer extends Model
{
    protected $table = 'oldservers';

    protected $fillable = [
        'user_id',
        'machine_id',
        'zone',
        'true_zone',
        'provider',
        'name',
        'ip',
        'token',
        'random',
        'time'
    ];

    public function owner()
    {
        return $this->belongsTo('App\User');
    }

}