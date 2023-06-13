<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StudentTest extends TestCase
{

    public function test_User_can_a_rendered_page_student()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->get('/students');
        $response->assertStatus(200)
            ->assertViewHas('students');
    }

    public function test_user_can_a_rendered_create_student_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->get('/students/create');
        $response->assertStatus(200)->assertViewIs('dashboard.create');
    }

    public function test_user_can_a_create_new_student()
    {
        $this->withoutExceptionHandling();

        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();
        $response = $this->post('/students', [
            'name' => 'mei',
            'nim' => '0823892',
            'email' => 'meizhika@gmail.com',
            'jurusan' => 'SI'
        ]);

        $response->assertRedirect('/students')
            ->assertSessionHas('success');
    }


    public function test_user_can_a_rendered_edit_page()
    {
        $this->withoutExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $response = $this->get('/students/mei/edit');
        $response->assertStatus(200)->assertViewIs('dashboard.edit')->assertViewHas('student');
    }

    public function test_user_can_update_a_student()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        Student::create([
            'name' => 'mei',
            'nim' => '0823892',
            'email' => 'meizhika@gmail.com',
            'jurusan' => 'SI'
        ]);

        $response = $this->put('/students/mei', [
            'name' => 'meizhika',
            'nim' => '0823892',
            'email' => 'meizhika@gmail.com',
            'jurusan' => 'SI'
        ]);

        $response->assertRedirect('/students')->assertSessionHas('success');
    }

    public function test_user_can_be_destroy_a_student()
    {
        $this->withExceptionHandling();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        Student::create([
            'name' => 'meizhika',
            'nim' => '0823892',
            'email' => 'meizhika@gmail.com',
            'jurusan' => 'SI'
        ]);

        $response = $this->delete('/students/meizhika');
        $response->assertRedirect('/students')->assertSessionHas('delete');
    }
}
