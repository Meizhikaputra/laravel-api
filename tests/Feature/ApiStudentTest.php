<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ApiStudentTest extends TestCase
{
    use RefreshDatabase;
    public function test_user_can_get_data_student_json()
    {
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->assertAuthenticated();

        $student = Student::all();

        if ($student->count() == 0) {
            $response = $this->get('/api');
            $response->assertStatus(404)->assertJson([
                'message' => 'Data Masih Kosong!',
                'status' => 404
            ], 404);
        }
        $student = Student::factory()->create();

        $response = $this->get('/api');
        $response->assertStatus(200);
    }
}
