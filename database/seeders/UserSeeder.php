<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $usuarios = [
            [
                'name' => 'Administrador',
                'email' => 'admin@example.com',
                'telefono' => '70000001',
                'direccion' => 'Oficina principal',
                'role' => 'administrador',
            ],
            [
                'name' => 'Supervisor',
                'email' => 'supervisor@example.com',
                'telefono' => '70000002',
                'direccion' => 'Area administrativa',
                'role' => 'supervisor',
            ],
            [
                'name' => 'Cajero',
                'email' => 'cajero@example.com',
                'telefono' => '70000003',
                'direccion' => 'Caja',
                'role' => 'cajero',
            ],
        ];

        foreach ($usuarios as $usuario) {
            $user = User::updateOrCreate(
                ['email' => $usuario['email']],
                [
                    'name' => $usuario['name'],
                    'password' => 'password',
                    'telefono' => $usuario['telefono'],
                    'direccion' => $usuario['direccion'],
                    'estado' => true,
                    'two_factor_enabled' => true,
                ]
            );

            $user->syncRoles([$usuario['role']]);
        }

        $usuarioAnterior = User::where('email', 'usuario@example.com')->first();

        if ($usuarioAnterior) {
            $usuarioAnterior->update([
                'name' => 'Usuario de consulta',
                'telefono' => '70000006',
                'direccion' => 'Consulta',
                'estado' => true,
                'two_factor_enabled' => true,
            ]);

            $usuarioAnterior->syncRoles(['cajero']);
        }

        User::whereIn('email', [
            'inventario@example.com',
            'reportes@example.com',
            'consulta@example.com',
        ])->update(['estado' => false]);
    }
}
