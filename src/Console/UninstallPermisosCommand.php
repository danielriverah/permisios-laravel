<?php

namespace Rivera\Permisos\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class UninstallPermisosCommand extends Command
{
    protected $signature = 'permisos:uninstall';
    protected $description = 'Desinstala los archivos del paquete permisos-laravel';

    public function handle()
    {
        $paths = [
            app_path('Models/Rol.php'),
            app_path('Models/Permiso.php'),
            app_path('Http/Controllers/RolController.php'),
            app_path('Http/Controllers/PermisoController.php'),
            config_path('permisos.php'),
        ];

        foreach ($paths as $path) {
            if (File::exists($path)) {
                File::delete($path);
                $this->info("Archivo eliminado: {$path}");
            } else {
                $this->warn("No se encontró: {$path}");
            }
        }

        $this->info('Archivos de permisos eliminados correctamente.');
    }
}
