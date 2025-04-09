<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisosTables extends Migration
{
    public function up()
    {
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
        Schema::create('usuario_roles', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('rol_id');

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');

            $table->primary(['usuario_id', 'rol_id']);
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
        Schema::create('usuario_permisos', function (Blueprint $table) {
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('permiso_id');
            $table->boolean('permitido')->default(true); // true = permitido, false = excluido

            $table->foreign('usuario_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary(['usuario_id', 'permiso_id']);
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
