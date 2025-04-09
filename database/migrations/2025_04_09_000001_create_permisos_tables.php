<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTables extends Migration
{
    public function up()
    {
        // Obtener dinámicamente el nombre de la tabla y la clave primaria del modelo de usuario
        $userTable = config('permisos.user_table'); // Obtenemos la tabla de usuario desde la configuración
        $userPrimaryKey = config('permisos.user_primary_key'); // Obtenemos la clave primaria del usuario

        // Tabla roles
        Schema::create('roles', function (Blueprint $table) {
            $table->id('rol_id');
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Tabla permisos
        Schema::create('permisos', function (Blueprint $table) {
            $table->id('permiso_id');
            $table->string('modulo');
            $table->string('accion');
            $table->text('descripcion')->nullable();
            $table->timestamps();
        });

        // Tabla usuario_roles
        Schema::create('usuario_roles', function (Blueprint $table) use($userTable, $userPrimaryKey) {
            $table->unsignedBigInteger($userPrimaryKey);
            $table->unsignedBigInteger('rol_id');

            $table->foreign($userPrimaryKey)->references($userPrimaryKey)->on($userTable)->onDelete('cascade');
            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');

            $table->primary([$userPrimaryKey, 'rol_id']);
        });

        // Tabla permisos_roles
        Schema::create('permisos_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('permiso_id');

            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary(['rol_id', 'permiso_id']);
        });

        // Tabla usuario_permisos (permisos individuales)
        Schema::create('usuario_permisos', function (Blueprint $table) use($userTable, $userPrimaryKey) {
            $table->unsignedBigInteger($userPrimaryKey);
            $table->unsignedBigInteger('permiso_id');
            $table->boolean('permitido')->default(true); // true = permitido, false = excluido

            $table->foreign($userPrimaryKey)->references($userPrimaryKey)->on($userTable)->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary([$userPrimaryKey, 'permiso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_permisos');
        Schema::dropIfExists('permisos_roles');
        Schema::dropIfExists('usuario_roles');
        Schema::dropIfExists('permisos');
        Schema::dropIfExists('roles');
    }
}
