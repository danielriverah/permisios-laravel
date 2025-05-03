<?php
namespace Rivera\Permisos\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class InstallPermisosCommand extends Command{
    protected $signature = 'permisos:install';
    protected $description = 'Publicar controladores y modelos del paquete de permisos';

    public function handle()
    {
        $basePath = base_path();
        // Publicar controladores
        $sourceControllers = __DIR__ . '/../Controllers';
        $targetControllers = $basePath . '/app/Http/Controllers/Permisos';
        if (!File::exists($targetControllers)) {
            File::makeDirectory($targetControllers, 0755, true);
        }
        File::copyDirectory($sourceControllers, $targetControllers);

        // Publicar modelos
        $sourceModels = __DIR__ . '/../Models';
        $targetModels = $basePath . '/app/Models/Permisos';
        if (!File::exists($targetModels)) {
            File::makeDirectory($targetModels, 0755, true);
        }
        File::copyDirectory($sourceModels, $targetModels);

        // Config
        $sourceConfig = __DIR__ . '/../../config/permisos.php';
        $targetConfig = config_path('permisos.php');
        if (!File::exists($targetConfig)) {
            File::copy($sourceConfig, $targetConfig);
            $this->info('Archivo de configuración copiado a config/permisos.php');
        } else {
            $this->warn('El archivo de configuración ya existe en config/permisos.php');
        }

        $this->info('Controladores y modelos publicados correctamente.');
    }
}
