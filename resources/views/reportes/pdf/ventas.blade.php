<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de ventas</title>
    @include('reportes.pdf.partials.styles')
</head>
<body>
    @include('reportes.pdf.partials.header', ['titulo' => 'Reporte de ventas'])

    <table class="summary">
        <tr>
            <td><div class="label">Ventas registradas</div><div class="value">{{ $ventas->count() }}</div></td>
            <td><div class="label">Total vendido</div><div class="value">{{ number_format($totalVentas, 2) }}</div></td>
        </tr>
    </table>

    <table>
        <thead><tr><th>Fecha</th><th>Usuario</th><th>Cliente</th><th>Documento</th><th>Metodo</th><th class="text-right">Subtotal</th><th class="text-right">Descuento</th><th class="text-right">Total</th></tr></thead>
        <tbody>
            @forelse ($ventas as $venta)
                <tr>
                    <td>{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                    <td>{{ $venta->user->name }}</td>
                    <td>{{ $venta->cliente_nombre ?? 'Sin nombre' }}</td>
                    <td>{{ $venta->cliente_documento ?? '-' }}</td>
                    <td>{{ $venta->metodo_pago }}</td>
                    <td class="text-right">{{ number_format($venta->subtotal, 2) }}</td>
                    <td class="text-right">{{ number_format($venta->descuento, 2) }}</td>
                    <td class="text-right">{{ number_format($venta->total, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="muted">Sin ventas en el periodo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Reporte generado por el sistema</div>
</body>
</html>
