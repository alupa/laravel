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

        $data = request()->validate([
            'name' => 'required'
        ], [
            'name.required' => 'El campo nombre es obligatorio' 
        ]);

        User::create([
            'name' =>$data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password'])
        ]);

        return redirect('usuarios'); // OR redirect()->route('users.index')
    }
}
