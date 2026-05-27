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

        $roles = [
            'administrador' => Permission::pluck('name')->all(),
            'supervisor' => [
                'productos.ver',
                'productos.crear',
                'productos.editar',
                'categorias.ver',
                'categorias.crear',
                'categorias.editar',
                'proveedores.ver',
                'proveedores.crear',
                'proveedores.editar',
                'cajas.ver',
                'cajas.crear',
                'cajas.editar',
                'compras.ver',
                'compras.crear',
                'ventas.ver',
                'ventas.crear',
                'movimientos-stock.ver',
                'reportes.ver',
            ],
            'cajero' => [
                'productos.ver',
                'cajas.ver',
                'cajas.crear',
                'cajas.editar',
                'ventas.ver',
                'ventas.crear',
                'movimientos-stock.ver',
            ],
        ];

        foreach ($roles as $roleName => $permissions) {
            $role = Role::firstOrCreate([
                'name' => $roleName,
                'guard_name' => 'web',
            ]);

            $role->syncPermissions($permissions);
        }

        Role::whereIn('name', ['usuario', 'inventario', 'reportes', 'consulta'])->delete();
    }
}
