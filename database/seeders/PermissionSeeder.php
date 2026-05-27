<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    public function run(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permissions = [
            'dashboard.admin',
            'usuarios.ver',
            'usuarios.crear',
            'usuarios.editar',
            'usuarios.eliminar',
            'roles.ver',
            'roles.crear',
            'roles.editar',
            'roles.eliminar',
            'productos.ver',
            'productos.crear',
            'productos.editar',
            'productos.eliminar',
            'categorias.ver',
            'categorias.crear',
            'categorias.editar',
            'categorias.eliminar',
            'proveedores.ver',
            'proveedores.crear',
            'proveedores.editar',
            'proveedores.eliminar',
            'cajas.ver',
            'cajas.crear',
            'cajas.editar',
            'cajas.eliminar',
            'compras.ver',
            'compras.crear',
            'compras.editar',
            'compras.eliminar',
            'ventas.ver',
            'ventas.crear',
            'ventas.editar',
            'ventas.eliminar',
            'movimientos-stock.ver',
            'reportes.ver',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        }
    }
}
