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
            //modelos
            app_path('Models/Permisos/Rol.php'),
            app_path('Models/Permisos/Permiso.php'),
            //controladores
            app_path('Http/Controllers/Permisos/RolController.php'),
            app_path('Http/Controllers/Permisos/PermisosController.php'),
            app_path('Http/Controllers/Permisos/UsersPermisosController.php'),
            //migraciones
            database_path('migrations/0009_00_0000001_create_roles_tabla.php'),
            database_path('migrations/0009_00_0000002_create_permisos_tabla.php'),
            database_path('migrations/0009_00_0000003_create_permisos_roles_tabla.php'),
            database_path('migrations/0009_00_0000004_create_permisos_usuarios_tabla.php'),
            database_path('migrations/0009_00_0000005_create_permisos_usuarios_roles_tabla.php'),
            //vistas roles
            resource_path('views/permisos/roles/index.blade.php'),
            resource_path('views/permisos/roles/create.blade.php'),
            resource_path('views/permisos/roles/edit.blade.php'),
            //vistas permisos
            resource_path('views/permisos/permisos/index.blade.php'),
            resource_path('views/permisos/permisos/create.blade.php'),
            resource_path('views/permisos/permisos/edit.blade.php'),
            //vistas componentes
            resource_path('views/permisos/components/alerta.blade.php'),
            //vistas usuario roles permisos
            resource_path('views/permisos/roles/usuario/index.blade.php'),
            resource_path('views/permisos/roles/usuario/create.blade.php'),
            resource_path('views/permisos/roles/usuario/edit.blade.php'),
            resource_path('views/permisos/roles/usuario/show.blade.php'),
            //Middlwares
            app_path('Http/Middleware/CheckPermisos.php'),
            
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
        $pathsDocUpdate=[
            base_path('routes')  => [
                'web.php'=>[
                    "Route::resource('roles', 'Permisos\RolController')->parameters(['roles' => 'id']);",
                    "Route::resource('permisos', 'Permisos\PermisosController')->parameters(['permisos' => 'id']);",
                    "Route::resource('userspermisos', 'Permisos\UsersPermisosController')->parameters(['userspermisos' => 'id']);",
                ],
            ],
            app_path()  => [
                'Kernel.php'=> [
                    "use App\Http\Middleware\CheckPermisos:class,",
                ],
            ],
        ];
        foreach ($pathsDocUpdate as $path => $files) {
            if (File::exists($path)) {
                foreach ($files as $file => $lines) {
                    $filePath = $path . '/' . $file;
                    if (File::exists($filePath)) {
                        File::copy($filePath, $filePath . '.bak');
                        try{
                        $content = File::get($filePath);
                        foreach ($lines as $line) {
                            $content = str_replace($line, '', $content);
                        }
                        File::put($filePath, $content);
                        $this->info("Archivo modificado: {$filePath}");
                        }catch(\Exception $e){
                            $this->error("Error al modificar el archivo: {$filePath}");
                            $this->error($e->getMessage());
                            File::copy($filePath . '.bak', $filePath);
                        }
                        File::delete($filePath . '.bak');
                    } else {
                        $this->warn("No se encontró: {$filePath}");
                    }
                }
            } else {
                $this->warn("No se encontró: {$path}");
            }
        }
        $this->info('Archivos modificados correctamente.');
    }
}
