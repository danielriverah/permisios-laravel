<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('permisos', function (Blueprint $table) {
            $table->increments('permiso_id')->unsigned()->index();
            $table->string('modulo');
            $table->string('accion');
            $table->text('descripcion')->nullable();
            $table->string('ruta')->nullable();
            $table->string('path')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('usuario_creacion');
            $table->timestamp('fecha_modificacion')->nullable()->useCurrentOnUpdate();
            $table->string('usuario_modificacion')->nullable();
            //$table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('permisos');
    }
};
