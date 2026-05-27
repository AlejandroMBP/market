<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte general</title>
    @include('reportes.pdf.partials.styles')
</head>
<body>
    @include('reportes.pdf.partials.header', ['titulo' => 'Reporte general'])

    <table class="summary">
        <tr>
            <td><div class="label">Total ventas</div><div class="value">{{ number_format($totalVentas, 2) }}</div></td>
            <td><div class="label">Total compras</div><div class="value">{{ number_format($totalCompras, 2) }}</div></td>
            <td><div class="label">Ganancia estimada</div><div class="value">{{ number_format($totalVentas - $totalCompras, 2) }}</div></td>
        </tr>
    </table>

    <div class="section-title">Ultimas ventas</div>
    <table>
        <thead><tr><th>Fecha</th><th>Cliente</th><th>Metodo</th><th class="text-right">Total</th></tr></thead>
        <tbody>
            @forelse ($ventas->take(12) as $venta)
                <tr><td>{{ $venta->fecha->format('d/m/Y H:i') }}</td><td>{{ $venta->cliente_nombre ?? $venta->cliente_documento ?? 'Sin datos' }}</td><td>{{ $venta->metodo_pago }}</td><td class="text-right">{{ number_format($venta->total, 2) }}</td></tr>
            @empty
                <tr><td colspan="4" class="muted">Sin ventas en el periodo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="section-title">Productos con bajo stock</div>
    <table>
        <thead><tr><th>Producto</th><th>Categoria</th><th class="text-right">Stock</th><th class="text-right">Minimo</th></tr></thead>
        <tbody>
            @forelse ($productosBajoStock as $producto)
                <tr><td>{{ $producto->nombre }}</td><td>{{ $producto->categoria->nombre }}</td><td class="text-right">{{ $producto->stock }}</td><td class="text-right">{{ $producto->stock_minimo }}</td></tr>
            @empty
                <tr><td colspan="4" class="muted">No hay productos con bajo stock.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Reporte generado por el sistema</div>
</body>
</html>
