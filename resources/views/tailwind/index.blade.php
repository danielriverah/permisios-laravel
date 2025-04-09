@extends(config('permisos.view_style') === 'tailwind' ? 'permisos::layouts.tailwind' : 'permisos::layouts.materialize')

@section('content')
    <h2>Roles</h2>
    <a href="{{ route('permisos.roles.create') }}">Crear Rol</a>
    <ul>
        @foreach($roles as $rol)
            <li>{{ $rol->nombre }} <a href="{{ route('permisos.roles.edit', $rol) }}">Editar</a></li>
        @endforeach
    </ul>
@endsection