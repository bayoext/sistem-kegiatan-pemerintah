<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Category;
use App\Models\Program;
use App\Models\User;
use App\Policies\CategoryPolicy;
use App\Policies\ProgramPolicy;
use App\Policies\UserPolicy;

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
        Gate::policy(Category::class, CategoryPolicy::class);
        Gate::policy(Program::class, ProgramPolicy::class);
        Gate::policy(User::class, UserPolicy::class);
        
        // Define custom gates
        Gate::define('manage-users', function (User $user) {
            return $user->isSuperAdmin();
        });
    }
}
