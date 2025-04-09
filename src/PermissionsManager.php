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
}
