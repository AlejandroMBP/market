<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Administrador',
                'password' => 'password',
            ]
        );

        $admin->assignRole('administrador');

        $usuario = User::updateOrCreate(
            ['email' => 'usuario@example.com'],
            [
                'name' => 'Usuario de prueba',
                'password' => 'password',
            ]
        );

        $usuario->assignRole('usuario');
    }
}
