<?php
namespace Rivera\Permisos;

class PermissionsManager
{
    public function tienePermiso($usuario, $modulo, $accion)
    {
        // Verificar si el usuario tiene un permiso específico
        // Buscar primero en permisos individuales, luego en permisos de rol
        // Lógica de exclusiones si existe alguna
    }

    public function obtenerPermisos($usuario)
    {
        // Obtener todos los permisos de un usuario
        // Debería manejar permisos tanto globales como individuales
    }
    public static function getUserModel()
    {
        // Obtener configuración de tabla y primary key
        $table = config('permisos.user_model.table', 'users'); // Valor por defecto 'users'
        $primaryKey = config('permisos.user_model.primary_key', 'id'); // Valor por defecto 'id'

        // Devolver el modelo con la configuración personalizada
        $userModel = \App\Models\User::query()
            ->setTable($table) // Establecer la tabla configurada
            ->setKeyName($primaryKey); // Establecer la clave primaria configurada

        return $userModel;
    }
}
