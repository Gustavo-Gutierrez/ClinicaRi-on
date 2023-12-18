<?php

namespace Database\Seeders;

use App\Models\Administrativo;
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
            'id'=>106,
            'name' => 'admin',
            'email' => 'testapp1715@gmail.com',
            'password' => '$2y$10$eeen6m6CJwNpEQk3XyPZ4eLR1SUPDzfI/BsjwX9phS9By5LlBE7N6',  //1234567890
        ])->assignRole('Administrador');
        Administrativo::create([
            'usuario_id' => 106,
            'cargo' => 'Administrador',
        ]);
    }
}
