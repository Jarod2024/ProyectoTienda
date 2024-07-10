<?php

namespace App\Providers;

use App\Models\Cliente;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Policies\ClientePoliciy;
use App\Policies\PermissionPoliciy;
use App\Policies\RolePoliciy;
use App\Policies\UserPoliciy;

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
        Model::unguard();

        // Definimos las policies dentro de este fichero
        // pues el comando de creacion de policies no crea
        // las policies en el directorio correcto
        Gate::policy(User::class, UserPoliciy::class);
        Gate::policy(Role::class, RolePoliciy::class);
        Gate::policy(Permission::class, PermissionPoliciy::class);
        Gate::policy(Cliente::class, ClientePoliciy::class);
    }
}
