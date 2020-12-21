<?php

namespace App\Providers;

use App\Permission;
use App\User;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

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
    public function boot()
    {
        $this->registerPolicies();

        Gate::before(function($user) {
            if($user->is_admin()) return true;
        });

        foreach (Permission::all() as $permission) {
            Gate::define($permission->name , function($user) use ($permission){
                return $user->hasPermission($permission);
            });
        }
    }
}
