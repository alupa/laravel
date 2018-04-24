<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class WelcomeUsersTest extends TestCase
{
    /** @test */
    function it_welcomes_users_with_nickname(){
        $this->get('saludo/alvaro/alhzombie')
            ->assertStatus(200)
            ->assertSee('Bienvenido Alvaro, tu apodo es alhzombie');
    }

    /** @test */
    function it_welcomes_users_without_nickname(){
        $this->get('saludo/alvaro')
            ->assertStatus(200)
            ->assertSee('Bienvenido Alvaro');
    }
}
