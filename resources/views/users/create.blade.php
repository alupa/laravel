@extends('layout')

@section('title', "UCrear usuario")

@section('content')
    <h1>Crear usuario</h1>
    
    <form method="POST" action="{{ url('usuarios') }}">
        {{ csrf_field() }}
        <button type="submit">Crear usuario</button>
    </form>

    <p><a href="{{ route('users.index')}}">Regresar</a></p>
@endsection