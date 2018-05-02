<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index(){

        // request('data');
        /*if (request()->has('empty')){
            $users = [];
        } else {
            $users = [
                'Gerardo', 'Mario', 'Alvaro',
            ];
        }*/

        //$users = DB::table('users')->get();
        $users = User::all();

        $title = "Listado de usuarios";

        /*return view('users')->with([
            'users' => $users,
            'title' => 'Listado de usuarios'
        ]);

        OR

        return view('users')
            ->with('users', $users)
            ->with('title', 'Listado de usuarios');
        
        OR

        return view('users', [
            'users' => $users,
            'title' => $title
        ]);*/

        //dd(compact('title', 'users')); //dd esquivale a hacer un var_dump() & die; en php

        return view('users.index', compact('title', 'users'));
    }

    public function show(User $user){
        //$user = User::findOrFail($id);
        //if ($user == null){
        //return response()->view('errors.404', [/*datos*/], 404);
        //}
        return view('users.show', compact('user'));
    }

    public function create(){
        return view('users.create');
    }

    public function store(){

        /*$data = request()->all();

        if (empty($data['name'])){
            return redirect('usuarios/nuevo')->withErrors([
                'name' => 'El campo nombre es obligatorio'
            ]);
        }*/

        //return redirect('usuarios/nuevo')->withInput(); //se encarga de regresar los datos ingresado en el form en caso de errores automaticamente

        $data = request()->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email', // OR ['required', 'email'],
            'password' => 'required|alpha_num|between:6,14'
        ], [
            'name.required' => 'El campo nombre es obligatorio',
            'email.required' => 'El campo email es obligatorio',
            'email.email' => 'El correo debe tener un formato adecuado: sucorreo@example.com',
            'email.unique' => 'El correo suministrado ya existe',
            'password.required' => 'El campo password es obligatorio',
            'password.alpha_num' => 'El password debe tener solo numero alphanumericos',
            'password.between' => 'El password debe tener entre 6 a 14 caracteres',
        ]);

        User::create([
            'name' =>$data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios'); // OR redirect()->route('users.index')
    }
}
