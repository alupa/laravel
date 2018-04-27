@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    <hr>
    <!-- en remplazo de @if (!empty($users)) @endif tambien puedes usar 
    @unless (empty($users)) @endunless OR @empty($users) cambiar orden aqui @endempty -->
    @if (!empty($users)) 
        <ul>
            @foreach($users as $user)
                <li>{{ $user->name }}, ({{$user->email }})</li>
            @endforeach
        </ul>
            @else
                <p>No hay usuarios registrados.</p>
            @endif
            <!-- Tambien puedes reemplazar el bloque de codigo anterior por esto
                <ul>
                    @forelse ($users as $user)
                        <li>{{ $user->name }}</li>
                    @empty
                        <li>No hay usuarios registrados.</li>
                    @endforelse
                </ul>
            -->
@endsection

@section('sidebar')
    @parent
    <h2>Barra lateral personalizada</h2>
@endsection