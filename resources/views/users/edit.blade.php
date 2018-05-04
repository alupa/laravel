@extends('layout')

@section('title', "Editar usuario")

@section('content')
    <h1>Editar usuario</h1>

    @if ($errors->any())
    <div class="alert alert-danger">
        <h6>Por favor corrige los errores debajo.</h6>
        {{--<ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>--}}
    </div>
    @endif
    
    <form method="POST" action="{{ url("usuarios/{$user->id}") }}">
        {{ method_field('PUT') }}
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Nombre:</label>
            <input type="text" class="form-control @if ($errors->has('name')) is-invalid  @endif" name="name" id="name" placeholder="Jhon Doe" value="{{ old('name', $user->name) }}">
            @if ($errors->has('name'))
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control @if ($errors->has('email')) is-invalid  @endif" name="email" id="email" placeholder="jhon@doe.com" value="{{ old('email', $user->email) }}">
            @if ($errors->has('email'))
            <div class="invalid-feedback">{{ $errors->first('email') }}</div>
            @endif
        </div>
        <div class="form-group">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control @if ($errors->has('password')) is-invalid  @endif" name="password" id="password" placeholder="Mayor a 6 caracteres">
            @if ($errors->has('password'))
            <div class="invalid-feedback">{{ $errors->first('password') }}</div>
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar usuario</button>
        <a class="btn btn-link" href="{{ route('users.index')}}">Regresar</a>
    </form>
@endsection