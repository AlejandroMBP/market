<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de venta</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
        <div class="grid gap-3 sm:grid-cols-4 text-sm">
            <div><strong>Fecha:</strong> {{ $venta->fecha->format('d/m/Y H:i') }}</div><div><strong>Metodo:</strong> {{ $venta->metodo_pago }}</div><div><strong>Total:</strong> {{ number_format($venta->total, 2) }}</div><div><strong>Cambio:</strong> {{ number_format($venta->cambio, 2) }}</div>
        </div>
        <div class="mt-4 grid gap-3 sm:grid-cols-2 text-sm">
            <div><strong>NIT/CI:</strong> {{ $venta->cliente_documento ?? 'Sin documento' }}</div>
            <div><strong>Cliente:</strong> {{ $venta->cliente_nombre ?? 'Sin nombre' }}</div>
            <div><strong>Caja:</strong> {{ $venta->caja ? '#'.$venta->caja->id.' - '.$venta->caja->estado : 'Sin caja' }}</div>
            <div><strong>Cajero:</strong> {{ $venta->user->name }}</div>
        </div>
        <table class="mt-6 min-w-full divide-y divide-gray-200"><thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Producto</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Cantidad</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Precio</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Subtotal</th></tr></thead><tbody class="divide-y divide-gray-200">@foreach ($venta->detalles as $detalle)<tr><td class="px-4 py-3 text-sm">{{ $detalle->producto->nombre }}</td><td class="px-4 py-3 text-sm">{{ $detalle->cantidad }}</td><td class="px-4 py-3 text-sm">{{ number_format($detalle->precio_venta, 2) }}</td><td class="px-4 py-3 text-sm">{{ number_format($detalle->subtotal, 2) }}</td></tr>@endforeach</tbody></table>
        <div class="mt-6"><a href="{{ route('ventas.index') }}" class="text-sm text-gray-600">Volver al listado</a></div>
    </div></div></div></div>
</x-app-layout>
