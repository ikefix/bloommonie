<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
public function boot(): void
{
    parent::boot();

    $this->routes(function () {
        Route::middleware('web')
            ->group(base_path('routes/web.php'));

        Route::middleware('web') // Load your POS routes
            // ->prefix('client')    // Optional: Prefix if needed
            ->group(base_path('routes/pos.php'));
    });
}

}
