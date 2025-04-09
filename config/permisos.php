<?php
return [
    // Nombre de la tabla de usuarios y su primary key para adaptabilidad
    'user_model' => \App\Models\User::class,  // Modelo de usuario predeterminado
    'user_primary_key' => 'id',               // Clave primaria del modelo de usuario
    'role_table' => 'roles',                  // Tabla de roles
    'permission_table' => 'permisos',         // Tabla de permisos
    'user_role_table' => 'usuario_roles',    // Tabla intermedia usuario-rol
    'permission_role_table' => 'permisos_roles', // Tabla intermedia permiso-rol
    'user_permission_table' => 'usuario_permisos', // Tabla intermedia usuario-permiso
    'providers' => [
        // ...
        //Rivera\Permisos\PermisosServiceProvider::class,
    ],
];
