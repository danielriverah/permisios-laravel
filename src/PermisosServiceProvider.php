<?php
// packages/TuEmpresa/Permisos/src/PermisosServiceProvider.php

namespace Rivera\Permisos;

use Illuminate\Support\ServiceProvider;

class PermisosServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Publicar config
        $this->mergeConfigFrom(__DIR__.'/../config/permisos.php', 'permisos');
    }

    public function boot()
    {
        // Publicar archivos si el usuario quiere copiar
        $this->publishes([
            __DIR__.'/../config/permisos.php' => config_path('permisos.php'),
        ], 'config');
        // Publicar migraciones
        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__.'/../resources/views/tailwind' => resource_path('views/vendor/permisos/tailwind'),
            __DIR__.'/../resources/views/materialize' => resource_path('views/vendor/permisos/materialize'),
        ], 'permisos-views');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
        //$this->loadViewsFrom(__DIR__.'/../resources/views', 'permisos');
        $this->loadViewsFrom(__DIR__.'/../resources/views/'.config('permisos.view_style'), 'permisos');
    }
}

