<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\ProductService;

class ProductServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(ProductService::class, function ($app) {
            $products = [
                ['id' => 1, 'name' => 'Apple', 'category' => 'Fruit'],
                ['id' => 2, 'name' => 'Broccoli', 'category' => 'Vegetables'],
                ['id' => 3, 'name' => 'Sardines', 'category' => 'Fish']
            ];
            
            return new ProductService($products);
        });
    }

    public function boot(): void
    {
        view()->share('productKey', 'abc123');
    }
}
