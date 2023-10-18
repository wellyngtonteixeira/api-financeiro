<?php

namespace App\Providers;

use App\Models\Item;
use App\Observers\ItemObserver;
use App\Repositories\Contracts\ItemRepositoryInterface;
use App\Repositories\ItemEloquentORM;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
//        $this->app->bind(
//            ItemRepositoryInterface::class,
//            ItemEloquentORM::class
//        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //Item::observe(ItemObserver::class);
    }
}
