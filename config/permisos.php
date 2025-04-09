<?php
return [
    // Nombre de la clase del modelo de usuario, útil para que la librería sea flexible
    'user_model' => User::class,  // Modelo de usuario predeterminado

    // Obtener dinámicamente el nombre de la tabla del modelo de usuario
    'user_table' => function() {
        return (new User)->getTable(); // Obtener el nombre de la tabla dinámicamente
    },

    // Obtener dinámicamente la clave primaria del modelo de usuario
    'user_primary_key' => function() {
        return (new User)->getKeyName(); // Obtener la clave primaria dinámicamente
    },
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
