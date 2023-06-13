<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        Student::create([
            'name' => 'rani sayang',
            'nim' => '018238282',
            'email' => 'rani_ie@gmail.com',
            'jurusan' => 'hati gua',
        ]);
        Student::create([
            'name' => 'selly sayang',
            'nim' => '018238290',
            'email' => 'selly_ie@gmail.com',
            'jurusan' => 'hati gua',
        ]);
        Student::create([
            'name' => 'nova sayang',
            'nim' => '018238200',
            'email' => 'nova_ie@gmail.com',
            'jurusan' => 'hati gua',
        ]);
        User::create([
            'name' => 'rani sayang',
            'email' => 'rani_ie@gmail.com',
            'password' => Hash::make('12345')
        ]);
    }
}
