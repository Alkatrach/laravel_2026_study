<?php

namespace App\Providers;

use App\Models\Turtle;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
    }

    public function boot(): void
    {
        Gate::define('is-admin', fn (User $user) => $user->is_admin);

        Gate::define('update-turtle', fn (User $user, Turtle $turtle) => $user->is_admin || $turtle->user_id === $user->id);

        Gate::define('delete-turtle', fn (User $user, Turtle $turtle) => $user->is_admin || $turtle->user_id === $user->id);
    }
}
