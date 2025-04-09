<?php
namespace App\Models\Permisos;

use Illuminate\Database\Eloquent\Model;

class Permiso extends Model
{
    protected $table = 'permisos';
    protected $primaryKey = 'permiso_id';
    protected $guarded = [];

    public function roles()
    {
        return $this->belongsToMany(Rol::class, 'permisos_roles', 'permiso_id', 'rol_id');
    }
}
