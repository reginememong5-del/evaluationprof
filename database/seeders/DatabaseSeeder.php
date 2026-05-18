<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Subject;
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

        User::create(['name'=>'Etudiant Test', 'email'=>'etudiant@test.com','password'=>Hash::make('password')]);
        Teacher::create(['nom'=>'MBIA', 'prenom'=>'Cyrille', 'email'=>'cyrillembia@ecole.com']);
        Teacher::create(['nom'=>'Belinga', 'prenom'=>'Estelle', 'email'=>'estellebelinga@ecole.com']);
        Teacher::create(['nom'=>'KEMEGNE', 'prenom'=>'Kemegne', 'email'=>'kemegne@ecole.com']);
        Subject::create(['nom'=>'Laravel', 'code'=>'101']);
        Subject::create(['nom'=>'Django', 'code'=>'102']);
        Subject::create(['nom'=>'SQL-Server', 'code'=>'103']);
    }
}
