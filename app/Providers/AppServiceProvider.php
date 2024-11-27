<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Schema;
use Inertia\Inertia;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
        if (config('app.env') === 'production') {
            URL::forceScheme('https');
        }

        Inertia::share([
            'auth.roles' => function () {
                if (Auth::check()) {
                    $auth_user = Auth::user();
                    $user      = User::find($auth_user->id);
                    return [
                        'id' => $user->id,
                        'name' => $user->name,
                        'roles' => $user->getRoleNames()->pluck("name"), // Obtener roles
                        'permissions' => $user->getPermissionNames()->pluck('name'), // Obtener permisos
                    ];
                }
                return null;
            },
        ]);
    }
}
