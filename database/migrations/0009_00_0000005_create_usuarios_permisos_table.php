<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Obtener dinámicamente el nombre de la tabla y la clave primaria del modelo de usuario
        $userTable = config('permisos.user_table'); // Obtenemos la tabla de usuario desde la configuración
        $userPrimaryKey = config('permisos.user_primary_key'); // Obtenemos la clave primaria del usuario

        Schema::create('usuario_permisos', function (Blueprint $table) use($userTable, $userPrimaryKey) {
            $table->increments('usuario_permiso_id'); // Clave primaria de la tabla
            $table->unsigneInteger($userPrimaryKey);
            $table->unsignedInteger('permiso_id');
            $table->boolean('permitido')->default(true); // true = permitido, false = excluido

            $table->foreign($userPrimaryKey)->references($userPrimaryKey)->on($userTable)->onDelete('cascade');
            $table->foreign('permiso_id')->references('permiso_id')->on('permisos')->onDelete('cascade');

            $table->primary([$userPrimaryKey, 'permiso_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('usuario_permisos');
    }
};
