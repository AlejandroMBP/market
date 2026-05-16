<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $administrador = Role::firstOrCreate([
            'name' => 'administrador',
            'guard_name' => 'web',
        ]);

        $usuario = Role::firstOrCreate([
            'name' => 'usuario',
            'guard_name' => 'web',
        ]);

        $administrador->syncPermissions(Permission::all());
        $usuario->syncPermissions([
            'usuarios.ver',
        ]);
    }
}
