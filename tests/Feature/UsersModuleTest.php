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
    function it_displays_the_users_details(){

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

    /** @test */
    function the_name_is_required(){
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => '',
                'email' => 'alvaro.lupa@gmail.com',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['name' => 'El campo nombre es obligatorio']);

        $this->assertDatabaseMissing('users', [
            'email' => 'alvaro.lupa@gmail.com',
        ]);
        // OR $this->assertEquals(0, User::count());
    }

    /** @test */
    function the_email_is_required(){
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Alvaro',
                'email' => '',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'email' => 'alvaro.lupa@gmail.com',
        ]);
    }

    /** @test */
    function the_email_must_be_valid(){
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Alvaro',
                'email' => 'correo-no-valido',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

        $this->assertDatabaseMissing('users', [
            'email' => 'alvaro.lupa@gmail.com',
        ]);
    }

    /** @test */
    function the_email_must_be_unique(){
        //$this->withoutExceptionHandling();

        factory(User::class)->create([
            'email' => 'alvaro.lupa@gmail.com'
        ]);

        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Alvaro',
                'email' => 'alvaro.lupa@gmail.com',
                'password' => '123456'
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['email']);

            $this->assertEquals(1, User::count());
    }

    /** @test */
    function the_password_is_required(){
        $this->from('usuarios/nuevo')
            ->post('/usuarios/', [
                'name' => 'Alvaro',
                'email' => 'alvaro.lupa@gmail.com',
                'password' => ''
            ])->assertRedirect('usuarios/nuevo')
            ->assertSessionHasErrors(['password']);

        $this->assertDatabaseMissing('users', [
            'email' => 'alvaro.lupa@gmail.com',
        ]);
        // OR $this->assertEquals(0, User::count());
    }

    /** @test */
    function it_loads_the_edit_user_page(){

        //$this->withoutExceptionHandling();
        $user = factory(User::class)->create();

        $this->get("/usuarios/{$user->id}/editar")
            ->assertStatus(200)
            ->assertViewIs('users.edit')
            ->assertSee('Editar usuario')
            ->assertViewHas('user', function($viewUser) use ($user){
                return $viewUser->id === $user->id;
            });
    }

    /** @test */
    function it_updates_a_user(){
        $user = factory(User::class)->create();

        $this->withoutExceptionHandling();

        $this->put("/usuarios/{$user->id}", [
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            'password' => '123456'
        ])->assertRedirect("/usuarios/{$user->id}"); // OR assertRedirect(route('users.index'))

        $this->assertCredentials([
            'name' => 'Alvaro',
            'email' => 'alvaro.lupa@gmail.com',
            'password' => '123456'
        ]);
    }
}
