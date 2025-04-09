<?php
namespace App\Models\Permisos;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
    protected $table = 'roles';
    protected $primaryKey = 'rol_id';
    protected $guarded = [];
    protected $fillable = ['nombre', 'descripcion'];

    public function permisos()
    {
        return $this->belongsToMany(Permiso::class, 'permisos_roles', 'rol_id', 'permiso_id');
    }

    public function usuarios()
    {
        $userModel = config('permisos.user_model');
        $userPrimaryKey = (config('permisos.user_primary_key'))();
        return $this->belongsToMany($userModel, 'usuario_roles', 'rol_id', $userPrimaryKey);
    }
}
