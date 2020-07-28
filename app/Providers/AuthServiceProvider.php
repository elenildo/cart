<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Permission;
use App\User;
// use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(User $user)
    {
        $this->registerPolicies();

        $permissions = Permission::with('roles')->get();

        foreach ($permissions as $permission){
            Gate::define($permission->name, function (User $user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
