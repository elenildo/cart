<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Order');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_users');
    }

    public function hasAnyRoles($roles)
    {
        if ( is_array($roles) || is_object($roles) ) {
            return $roles->intersect($this->roles);
        }

        return $this->roles->contains('name', $roles);
    }

    public function hasPermission(Permission $permission)
    {
        return !! $this->hasAnyRoles($permission->roles)->count();
    }

    public function isAdmin()
    {
        $role = Role::find(1); //Admin

        if ($this->hasAnyRoles($role->name)) {
            return true;
        }
            
        return false;
    }
}
