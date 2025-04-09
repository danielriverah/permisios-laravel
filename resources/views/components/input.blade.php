@php
$style = config('permisos.view_style', 'tailwind');
@endphp

@if($style === 'tailwind')
    <input {{ $attributes->merge(['class' => 'border p-2 rounded w-full']) }} />
@elseif($style === 'materialize')
    <div class=\"input-field\">
        <input {{ $attributes }} />
    </div>
@endif