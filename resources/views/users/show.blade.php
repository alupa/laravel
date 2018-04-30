@extends('layout')

@section('title', "Usuario {$user->id}")

@section('content')
    <h1>Usuario #{{ $user->id }}</h1>
    
    <p>Nombre de usuario: {{ $user->name }}</p>
    <p>Correo electrónico: {{ $user->email }}</p>

    <p><a href="{{ route('users.index')}}">Regresar</a></p>
    <!-- OR url('/usuarios') OR url()->previous() OR action('UserController@index') -->
    <!--
        url()->current(); // URL completa

        url()->full(); // URL completa con la cadena de consulta
        
    -->

@endsection