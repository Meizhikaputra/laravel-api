<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\App;
use Tests\TestCase;


class LoginTest extends TestCase
{

    public function test_get_url_login_can_be_rendered()
    {
        $this->withoutExceptionHandling();

        $response = $this->get('/');
        $response->assertStatus(200)
            ->assertViewIs('login');
    }

    public function test_user_authenticate()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect('/students');
    }

    public function test_user_not_authenticate()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'wrong-password'
        ]);

        $response->assertRedirect('/')->assertSessionHas('message');
    }
}
