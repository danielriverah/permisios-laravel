<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTables extends Migration
{
    public function up()
    {
        Schema::create('permisos_roles', function (Blueprint $table) {
            $table->increments('permiso_rol_id'); // Clave primaria de la tabla
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('permiso_id');

            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary(['rol_id', 'permiso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_permisos');
    }
}
