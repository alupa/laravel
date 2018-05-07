@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-end mb-2">
        <h1 class="pb-1">{{ $title }}</h1>
        <a href="{{ route('users.create') }}" class="btn btn-primary">Nuevo usuario</a>
    </div>
    
    {{-- en remplazo de @if (!empty($users)) @endif tambien puedes usar 
    @unless (empty($users)) @endunless OR @empty($users) cambiar orden aqui @endempty --}}

    @if ($users->isNotEmpty())
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
                @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('users.show', $user) }}" class="btn btn-link"><i class="fas fa-eye"></i></a>
                            <!-- OR url("usuarios/{$user->id}") OR action('UserController@show', ['id' => $user->id]) -->
                            <a href="{{ route('users.edit', $user) }}" class="btn btn-link"><i class="far fa-edit"></i></a>
                            <button type="submit" class="btn btn-link"><i class="fas fa-trash"></i></button>
                        </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No hay usuarios registrados.</p>
    @endif

    {{--
        @if (!empty($users)) 
        <ul>
        @foreach($users as $user)
                li>{{ $user->name }}, ({{$user->email }})</li>
         @endforeach
        </ul>
        @else
            <p>No hay usuarios registrados.</p>
        @endif
    --}}

            {{-- Tambien puedes reemplazar el bloque de codigo anterior por esto
                <ul>
                    @forelse ($users as $user)
                        <li>{{ $user->name }}</li>
                    @empty
                        <li>No hay usuarios registrados.</li>
                    @endforelse
                </ul>
            --}}
@endsection

@section('sidebar')
    @parent
    <h2>Barra lateral personalizada</h2>
@endsection