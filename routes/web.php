<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Permisos\RolController;
use App\Http\Controllers\Permisos\PermisosController;

Route::prefix('admin/permisos')->middleware(['auth'])->group(function () {
    Route::resource('roles', RolController::class);
    Route::resource('permisos', PermisosController::class);
});