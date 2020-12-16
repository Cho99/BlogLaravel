<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\News;
use App\Models\Admin;
use App\Policies\RolePolicy;
use Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
        //App\Models\News::class => App\Policies\NewsPolicy
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {   
        $this->registerPolicies();
        // Gate::before(function($user) {
        //     //dd($user);
        //     return true;
        // });
        // Gate::define('view-news', function($user, $new) {
        //     return $user->id === $new;
        //     //return true;
        // });
    }
}
