<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])->group(function () {
    Route::view('/permisos/test', 'permisos::test');
});