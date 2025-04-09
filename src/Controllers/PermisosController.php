<?php
namespace Rivera\Permisos\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Rivera\Permisos\Models\Permisos\Rol;
use Rivera\Permisos\Models\Permisos\Permiso;

class PermisosController extends Controller
{
    private $style;
    public function __construct()
    {
        $this->style = config('permisos.view_style', 'materialize');
    }
    public function indexRoles() {
        return view('permisos::roles.index', ['roles' => Rol::all()]);
    }

    public function createRol() {
        return view('permisos::roles.create');
    }

    public function storeRol(Request $request) {
        Rol::create($request->only('nombre', 'descripcion'));
        return redirect()->route('permisos.roles.index');
    }

    public function editRol(Rol $rol) {
        return view('permisos::roles.edit', compact('rol'));
    }

    public function updateRol(Request $request, Rol $rol) {
        $rol->update($request->only('nombre', 'descripcion'));
        return redirect()->route('permisos.roles.index');
    }

    public function destroyRol(Rol $rol) {
        $rol->delete();
        return back();
    }

    // Igual para permisos...
}
