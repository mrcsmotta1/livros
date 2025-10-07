<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\AssuntoRepositoryInterface;
use App\Repositories\EloquentAssuntoRepository;
use App\Interfaces\Services\AssuntoServiceInterface;
use App\Services\AssuntoService;


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
        $this->app->bind(AssuntoRepositoryInterface::class, EloquentAssuntoRepository::class);
        $this->app->bind(AssuntoServiceInterface::class, AssuntoService::class);
    }
}
