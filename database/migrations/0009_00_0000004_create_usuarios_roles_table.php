<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        $userTable = config('permisos.user_table'); // Obtenemos la tabla de usuario desde la configuración
        $userPrimaryKey = config('permisos.user_primary_key'); // Obtenemos la clave primaria del usuario

        Schema::create('usuarios_roles', function (Blueprint $table) use($userTable, $userPrimaryKey) {
            $table->unsignedInteger($userPrimaryKey);
            $table->unsignedInteger('rol_id');
            $table->foreign($userPrimaryKey)->references($userPrimaryKey)->on($userTable)->onDelete('cascade');
            $table->foreign('rol_id')->references('rol_id')->on('roles')->onDelete('cascade');
            $table->timestamp('fecha_creacion')->useCurrent();
            $table->string('usuario_creacion')->default('SYSTEM');
            $table->timestamp('fecha_modificacion')->nullable()->useCurrentOnUpdate();
            $table->string('usuario_modificacion')->nullable();

            $table->primary([$userPrimaryKey, 'rol_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuarios_roles');
    }
};
