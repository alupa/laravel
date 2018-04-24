<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){

        // request('data');
        if (request()->has('empty')){
            $users = [];
        } else {
            $users = [
                'Gerardo', 'Mario', 'Alvaro',
            ];
        }

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

    public function show($id){
        return view('users.show', compact('id'));
    }

    public function create(){
        return 'Crear nuevo usuario';
    }
}
