<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider {
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot() {
        // Register the policies
        $this->registerPolicies();

        // Make model ungurded
        Model::unguard();

        // logedin a user for development mode
        // if ( $this->app->environment( 'local' ) ) {
        //     auth()->attempt( [
        //         'email'    => 'user1@greenovent.com',
        //         'password' => '12345678'
        //     ] );
        // }
    }
}
