<?php

namespace App\Providers;

use App\Filament\Resources\UserResource;
use App\Models\User;
use Filament\Facades\Filament;
use Filament\Navigation\UserMenuItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class FilamentServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(User $user): void
    {
        Filament::serving(function () {
            if (Auth::check() && Auth::user()->hasRole('admin')) {
                Filament::registerUserMenuItems([
                    UserMenuItem::make()
                        ->label('Settings')
                        ->url(UserResource::getUrl())
                        ->icon('heroicon-s-cog'),
                ]);
            }
        });
    }
}
