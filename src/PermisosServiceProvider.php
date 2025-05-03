<?php
// packages/TuEmpresa/Permisos/src/PermisosServiceProvider.php

namespace Rivera\Permisos;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class PermisosServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Publicar config
        $this->mergeConfigFrom(__DIR__.'/../config/permisos.php', 'permisos');
    }

    public function boot()
    {
       /* // Publicar archivos si el usuario quiere copiar
        $this->publishes([
            __DIR__.'/../config/permisos.php' => config_path('permisos.php'),
        ], 'config');
        // Publicar migraciones
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__.'/../resources/views/components' => resource_path('views/permisos/components'),
            __DIR__.'/../resources/views/'.config('permisos.view_style') => resource_path('views/permisos/'.config('permisos.view_style')),
        ], 'permisos-views');
        if (!$this->app->routesAreCached()) {
            $this->registerRoutes();
        }
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //$this->loadViewsFrom(__DIR__.'/../resources/views', 'permisos');
        $this->loadViewsFrom(__DIR__.'/../resources/views/'.config('permisos.view_style'), 'permisos');*/
        if ($this->app->runningInConsole()) {
            $this->commands([
                \Rivera\Permisos\Console\InstallPermisosCommand::class,
            ]);
        }
    }
    protected function registerRoutes()
    {
        // Route::middleware(['web', 'auth']) // o tus middlewares personalizados
        //     ->prefix(config('permisos.route_prefix', 'permisos'))
        //     ->name('permisos.')
        //     ->group(__DIR__.'/../routes/web.php');
    }
}

