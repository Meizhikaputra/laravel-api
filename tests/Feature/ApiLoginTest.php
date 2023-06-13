<?php

namespace Tests\Feature;

use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiLoginTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_authenticate()
    {
        $this->withExceptionHandling();

        $user = User::factory()->create();
        $response = $this->post('/api/login', [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertStatus(200);
    }


    public function test_api_authenticate_failed()
    {
        $response = $this->postJson('/api/login', [
            'email' => 'wrong-email@gmail.com',
            'password' => 'wrong-password'
        ]);

        $response->assertStatus(401)->assertJson([
            'message' => 'data yang anda masukan salah',
            'status' => 401

        ]);
    }
}
