<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('rol_id')->unsigned()->index();
            $table->string('nombre')->unique();
            $table->text('descripcion')->nullable();
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('usuario_creacion');
            $table->timestamp('fecha_modificacion')->nullable()->useCurrentOnUpdate();
            $table->string('usuario_modificacion')->nullable();
            $table->boolean('mutable')->default(true);
        });
    }

    public function down()
    {
        Schema::dropIfExists('roles');
    }
};
