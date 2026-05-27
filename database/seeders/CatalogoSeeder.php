<?php

namespace Database\Seeders;

use App\Models\Categoria;
use App\Models\MetodoPago;
use App\Models\Proveedor;
use Illuminate\Database\Seeder;

class CatalogoSeeder extends Seeder
{
    public function run(): void
    {
        $categorias = [
            ['nombre' => 'Bebidas', 'descripcion' => 'Productos liquidos'],
            ['nombre' => 'Snacks', 'descripcion' => 'Productos para consumo rapido'],
            ['nombre' => 'Lacteos', 'descripcion' => 'Productos derivados de leche'],
        ];

        foreach ($categorias as $categoria) {
            Categoria::firstOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion'], 'estado' => true]
            );
        }

        $metodosPago = [
            ['nombre' => 'Manual', 'descripcion' => 'Pago registrado manualmente'],
            ['nombre' => 'QR', 'descripcion' => 'Pago mediante QR'],
            ['nombre' => 'Tarjeta de credito', 'descripcion' => 'Pago con tarjeta de credito'],
        ];

        MetodoPago::whereNotIn('nombre', collect($metodosPago)->pluck('nombre')->all())
            ->update(['estado' => false]);

        foreach ($metodosPago as $metodoPago) {
            MetodoPago::updateOrCreate(
                ['nombre' => $metodoPago['nombre']],
                ['descripcion' => $metodoPago['descripcion'], 'estado' => true]
            );
        }

        Proveedor::firstOrCreate(
            ['nit' => '0'],
            [
                'nombre' => 'Proveedor general',
                'telefono' => null,
                'direccion' => null,
                'correo' => null,
                'estado' => true,
            ]
        );
    }
}
