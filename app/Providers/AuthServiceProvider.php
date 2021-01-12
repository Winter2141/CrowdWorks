<?php

namespace App\Providers;

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
        'App\Models\Favorite' => 'App\Policies\FavoritePolicy',
        'App\Models\FavoriteFolder' => 'App\Policies\FavoriteFolderPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isAdmin', function ($user) {
            return get_class($user) == 'App\Models\Admin' ? true : false;
        });

        Gate::define('isDoctor', function ($user) {
            return (get_class($user) == 'App\Models\User' && $user->user_kind == config('const.user_kind.doctor'))? true : false;
        });

        Gate::define('isComedical', function ($user) {
            return (get_class($user) == 'App\Models\User' && $user->user_kind == config('const.user_kind.comedical'))? true : false;
        });

        Gate::define('isMaker', function ($user) {
            return (get_class($user) == 'App\Models\User' && $user->user_kind == config('const.user_kind.maker'))? true : false;
        });

        Gate::define('isCorporation', function ($user) {
            return (get_class($user) == 'App\Models\User' && $user->user_kind == config('const.user_kind.corporation'))? true : false;
        });

        Gate::define('isPersonal', function ($user) {
            return (get_class($user) == 'App\Models\User' && $user->user_kind == config('const.user_kind.personal'))? true : false;
        });

    }
}
