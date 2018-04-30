<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;


class UsersModuleTest extends TestCase
{
    /* Incluye el trait RefreshDatabase en cada una de las pruebas que vaya a interactuar con 
    la base de datos. De esta manera, Laravel ejecutará las migraciones de la base de datos antes 
    de ejecutar las pruebas. Además ejecutará cada prueba dentro de una transacción de la 
    base de datos que será revertida después de ejecutar cada método de prueba. 
    De esta forma evitamos tener que migrar manualmente la base de datos y preocuparnos por datos 
    que podrían “contaminar” el estado de cada una de nuestras pruebas. */
    use RefreshDatabase; 

    /** @test */
    function it_shows_the_users_list()
    {
        factory(User::class)->create([
            'name' => 'Gerardo',
        ]);

        factory(User::class)->create([
            'name' => 'Mario',
        ]);

        $this->get('/usuarios')
             ->assertStatus(200)
             ->assertSee('Listado de usuarios')
             ->assertSee('Gerardo')
             ->assertSee('Mario');
    }

    /** @test */
    function it_shows_a_default_message_if_the_users_list_is_empty()
    {
        //DB::table('users')->truncate();

        $this->get('/usuarios')
             ->assertStatus(200)
             ->assertSee('No hay usuarios registrados');
    }

    /** @test */
    function it_loads_the_users_details(){

        $user = factory(User::class)->create([
            'name' => 'Alvaro Lupa'
        ]);

        $this->get('/usuarios/'.$user->id) //usuarios/3
            ->assertStatus(200)
            ->assertSee('Alvaro Lupa');
    }

    /** @test */
    function it_displays_a_404_error_if_the_user_is_not_found(){
        $this->get('/usuarios/999')
        ->assertStatus(404)
        ->assertSee('Página no encontrada');
    }

    /** @test */
    function it_loads_the_new_users_page(){

        //$this->withoutExceptionHandling();

        $this->get('/usuarios/nuevo')
            ->assertStatus(200)
            ->assertSee('Crear nuevo usuario');
    }

    /** @test */
    function it_creates_a_new_user(){

        $this->withoutExceptionHandling();

        $this->post('/usuarios/', [
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            'password' => '123456'
        ])->assertRedirect('usuarios'); // OR assertRedirect(route('users.index'))

        /*$this->assertDatabaseHas('users', [
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            //'password' => '123456'
        ]);*/

        $this->assertCredentials([
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            'password' => '123456'
        ]);
    }
}
