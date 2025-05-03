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
        $sourceControllers = __DIR__ . '/../Controllers';
        $targetControllers = $basePath . '/app/Http/Controllers/Permisos';

        $sourceModels = __DIR__ . '/../Models';
        $targetModels = $basePath . '/app/Models/Permisos';

        // Publicar controladores
        if (!File::exists($targetControllers)) {
            File::makeDirectory($targetControllers, 0755, true);
        }
        File::copyDirectory($sourceControllers, $targetControllers);

        // Publicar modelos
        if (!File::exists($targetModels)) {
            File::makeDirectory($targetModels, 0755, true);
        }
        File::copyDirectory($sourceModels, $targetModels);

        $this->info('Controladores y modelos publicados correctamente.');
    }
}
