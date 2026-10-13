<?php

namespace App\Providers;

use App\Contracts\Catalogo;
use App\Services\CatalogoDemonstracao;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Catalogo::class, CatalogoDemonstracao::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
