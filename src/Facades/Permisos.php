<?php
namespace Rivera\Permisos\Facades;

use Illuminate\Support\Facades\Facade;

class Permisos extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'permisos';  // Referencia a la clase de lógica principal
    }
}
