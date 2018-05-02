@extends('layout')

@section('title', "Crear usuario")

@section('content')
    <h1>Crear usuario</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por favor corrige los errores debajo:</h6>
        {{--<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>--}}
    </div>
    @endif
    
    <form method="POST" action="{{ url('usuarios') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Jhon Doe" value="{{ old('name') }}">
            @if ($errors->has('name'))
            <p>{{ $errors->first('name') }}</p>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control" name="email" id="email" placeholder="jhon@doe.com" value="{{ old('email') }}">
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" name="password" id="password" placeholder="Mayor a 6 caracteres">
        </div>
        <button type="submit" class="btn btn-primary">Crear usuario</button>
        <a class="btn btn-link" href="{{ route('users.index')}}">Regresar</a>
    </form>
@endsection