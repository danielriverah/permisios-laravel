<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles_permiso', function (Blueprint $table) {
            $table->unsignedInteger('rol_id');
            $table->unsignedInteger('permiso_id');
            $table->boolean('permite')->default(true);
            $table->unsignedInteger('prioridad')->default(1);

            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary(['rol_id', 'permiso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles_permiso');
    }
};
