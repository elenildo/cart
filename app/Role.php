<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $fillable = ['name', 'description'];
    
    public function permissions()
    {
        return $this->belongsToMany('App\Permission', 'role_permissions');
    }

    public function users()
    {
        return $this->belongsToMany('App\User', 'role_users');
    }
}
