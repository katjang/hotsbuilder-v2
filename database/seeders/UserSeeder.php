<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Stef',
            'email' => 'Stef@test.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'Boi',
            'email' => 'boi@test.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'SomeOtherDude',
            'email' => 'somedude@test.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'Pepe',
            'email' => 'pepe@test.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'Doggo',
            'email' => 'doggo@test.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'Harold',
            'email' => 'hide@thepain.com',
            'password' => bcrypt('testtest')
        ]);

        User::create([
            'name' => 'Smurf',
            'email' => 'smurf@test.com',
            'password' => bcrypt('testtest')
        ]);
    }
}
