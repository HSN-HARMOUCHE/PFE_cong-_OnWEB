<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('Admin-user', function ($user) {
            return $user->isAdmin(); 
        });
        // show or update info if the user is an Admin or is the owner of that info
        Gate::define('Info_user', function($user , $id){
            if( $user->isAdmin() || $user->mat == $id ){
                return TRUE ;
            }else{
                return FALSE ;
            }
        }) ;
    }
}
