<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Reporte de compras</title>
    @include('reportes.pdf.partials.styles')
</head>
<body>
    @include('reportes.pdf.partials.header', ['titulo' => 'Reporte de compras'])

    <table class="summary">
        <tr>
            <td><div class="label">Compras registradas</div><div class="value">{{ $compras->count() }}</div></td>
            <td><div class="label">Total comprado</div><div class="value">{{ number_format($totalCompras, 2) }}</div></td>
        </tr>
    </table>

    <table>
        <thead><tr><th>Fecha</th><th>Proveedor</th><th>Usuario</th><th>Comprobante</th><th>Estado</th><th class="text-right">Subtotal</th><th class="text-right">Descuento</th><th class="text-right">Total</th></tr></thead>
        <tbody>
            @forelse ($compras as $compra)
                <tr>
                    <td>{{ $compra->fecha->format('d/m/Y H:i') }}</td>
                    <td>{{ $compra->proveedor->nombre }}</td>
                    <td>{{ $compra->user->name }}</td>
                    <td>{{ $compra->tipo_comprobante }} {{ $compra->numero_comprobante }}</td>
                    <td>{{ $compra->estado }}</td>
                    <td class="text-right">{{ number_format($compra->subtotal, 2) }}</td>
                    <td class="text-right">{{ number_format($compra->descuento, 2) }}</td>
                    <td class="text-right">{{ number_format($compra->total, 2) }}</td>
                </tr>
            @empty
                <tr><td colspan="8" class="muted">Sin compras en el periodo.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">Reporte generado por el sistema</div>
</body>
</html>
