<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de inventario</title>
    @include('reportes.pdf.partials.styles')
</head>
<body>
    @include('reportes.pdf.partials.header', ['titulo' => 'Reporte de inventario'])

    <table class="summary">
        <tr>
            <td><div class="label">Productos</div><div class="value">{{ $productos->count() }}</div></td>
            <td><div class="label">Bajo stock</div><div class="value">{{ $productosBajoStock->count() }}</div></td>
            <td><div class="label">Sin stock</div><div class="value">{{ $productos->where('stock', '<=', 0)->count() }}</div></td>
        </tr>
    </table>

    <table>
        <thead><tr><th>Codigo</th><th>Producto</th><th>Categoria</th><th>Proveedor</th><th class="text-right">Stock</th><th class="text-right">Minimo</th><th class="text-right">Precio venta</th><th>Estado</th></tr></thead>
        <tbody>
            @forelse ($productos as $producto)
                <tr>
                    <td>{{ $producto->codigo_barra }}</td>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->categoria->nombre }}</td>
                    <td>{{ $producto->proveedor?->nombre ?? 'Sin proveedor' }}</td>
                    <td class="text-right">{{ $producto->stock }}</td>
                    <td class="text-right">{{ $producto->stock_minimo }}</td>
                    <td class="text-right">{{ number_format($producto->precio_venta, 2) }}</td>
                    <td>{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="muted">Sin productos registrados.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Reporte generado por el sistema</div>
</body>
</html>
