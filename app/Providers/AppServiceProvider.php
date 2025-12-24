<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Number;
use App\Actions\ValidatedCartStock;
use Illuminate\Support\Facades\Gate;
use App\Contract\CartServiceInterface;
use Illuminate\Support\ServiceProvider;
use App\Services\Cart\SessionCartService;
use App\Services\Region\RegionQueryService;
use App\Services\Shipping\ShippingMethodService;
use Illuminate\Validation\ValidationException;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(CartServiceInterface::class, SessionCartService::class);
        $this->app->bind(RegionQueryService::class, RegionQueryService::class);
        $this->app->bind(ShippingMethodService::class, ShippingMethodService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Number::useCurrency('IDR');

        Gate::define('is_stock_available', function(User $user = null) {
            try {
                ValidatedCartStock::run();
                return true;
            } catch (ValidationException $e) {
                session()->flash('error', $e->getMessage());
                return false;
            }
        });
    }
}
