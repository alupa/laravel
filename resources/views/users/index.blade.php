@extends('layout')

@section('content')
    <h1>{{ $title }}</h1>
    <a href="{{ route('users.create') }}">Nuevo usuario</a>
    <hr>

    <!-- en remplazo de @if (!empty($users)) @endif tambien puedes usar 
    @unless (empty($users)) @endunless OR @empty($users) cambiar orden aqui @endempty -->

    <table class="table table-striped">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Correo electrónico</th>
                <th scope="col">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <th scope="row">{{ $user->id }}</th>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td><a href="{{ route('users.show', $user) }}">Ver detalles</a> |
                    <!-- OR url("usuarios/{$user->id}") OR action('UserController@show', ['id' => $user->id]) -->
                        <a href="{{ route('users.edit', $user) }}">Editar</a>
                    <form action="{{ route('users.destroy', $user) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Eliminar</button>
                    </form>
                    </td>
                </tr>
            @empty
                <p>No hay usuarios registrados.</p>
            @endforelse
        </tbody>
    </table>

    <!--
        @if (!empty($users)) 
        <ul>
        @foreach($users as $user)
                li>{{ $user->name }}, ({{$user->email }})</li>
         @endforeach
        </ul>
        @else
            <p>No hay usuarios registrados.</p>
        @endif
    -->

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