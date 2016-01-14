<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'country','email', 'password','confirmation_code','username'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function servers()
    {
        return $this->hasMany('App\Models\VpnServer');
    }

    public function vpnusers()
    {
        return $this->hasMany('App\Models\VpnUser');
    }

    public function vpngroups()
    {
        return $this->hasMany('App\Models\VpnGroup');
    }

    public function vpnusersgroups()
    {
        return $this->hasMany('App\Models\VpnUsersGroups');
    }

    public function randomservers()
    {
        return $this->hasOne('App\Models\RandomServer');
    }
}
