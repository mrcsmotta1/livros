<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\Repositories\AssuntoRepositoryInterface;
use App\Repositories\EloquentAssuntoRepository;
use App\Interfaces\Services\AssuntoServiceInterface;
use App\Services\AssuntoService;
use App\Interfaces\Repositories\AutorRepositoryInterface;
use App\Repositories\EloquentAutorRepository;
use App\Interfaces\Services\AutorServiceInterface;
use App\Services\AutorService;
use App\Interfaces\Repositories\LivroRepositoryInterface;
use App\Repositories\EloquentLivroRepository;
use App\Interfaces\Services\LivroServiceInterface;
use App\Services\LivroService;


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

        $this->app->bind(AutorRepositoryInterface::class, EloquentAutorRepository::class);
        $this->app->bind(AutorServiceInterface::class, AutorService::class);

        $this->app->bind(LivroRepositoryInterface::class, EloquentLivroRepository::class);
        $this->app->bind(LivroServiceInterface::class, LivroService::class);
    }
}
