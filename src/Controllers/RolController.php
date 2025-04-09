<?php
namespace App\Http\Controllers\Permisos;

use App\Http\Controllers\Controller;
use App\Models\Permisos\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    private $style;
    public function __construct()
    {
        $this->style = config('permisos.view_style', 'materialize');
    }
    public function index()
    {
        return view('.roles.index', ['roles' => Rol::all()]);
    }

    public function create()
    {
        return view($this->style.'.roles.create');
    }

    public function store(Request $request)
    {
        Rol::create($request->all());
        return redirect()->route($this->style.'.roles.index');
    }

    public function edit(Rol $rol)
    {
        return view($this->style.'.roles.edit', compact('rol'));
    }

    public function update(Request $request, Rol $rol)
    {
        $rol->update($request->all());
        return redirect()->route('roles.index');
    }

    public function destroy(Rol $rol)
    {
        $rol->delete();
        return back();
    }
}
