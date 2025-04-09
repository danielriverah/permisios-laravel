<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTables extends Migration
{
    public function up()
    {
        $userTable = config('permisos.user_table'); // Obtenemos la tabla de usuario desde la configuración
        $userPrimaryKey = config('permisos.user_primary_key'); // Obtenemos la clave primaria del usuario

        Schema::create('usuario_roles', function (Blueprint $table) use($userTable, $userPrimaryKey) {
            $table->increments('usuario_rol_id'); // Clave primaria de la tabla,
            $table->unsignedInteger($userPrimaryKey);
            $table->unsignedInteger('rol_id');
            $table->foreign($userPrimaryKey)->references($userPrimaryKey)->on($userTable)->onDelete('cascade');
            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');

            $table->primary([$userPrimaryKey, 'rol_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_roles');
    }
}
