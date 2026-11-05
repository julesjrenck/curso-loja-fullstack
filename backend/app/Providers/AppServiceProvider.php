<?php

namespace App\Providers;

use App\Contracts\Catalogo;
use App\Models\User;
use App\Services\CatalogoEloquent;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(Catalogo::class, CatalogoEloquent::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Gate::define('acessar-administracao', function (User $user): bool {
            return $user->is_admin === true;
        });

        RateLimiter::for('login', function (Request $request): Limit {
            return Limit::perMinute(5)
                ->by($request->ip())
                ->response(function (Request $request, array $headers): JsonResponse {
                    return response()->json([
                        'message' => 'Muitas tentativas. Tente novamente em instantes.',
                    ], 429, $headers)->header('Cache-Control', 'no-store');
                });
        });
    }
}
