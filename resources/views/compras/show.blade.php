<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de compra</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
        <div class="grid gap-3 sm:grid-cols-3 text-sm">
            <div><strong>Proveedor:</strong> {{ $compra->proveedor->nombre }}</div>
            <div><strong>Fecha:</strong> {{ $compra->fecha->format('d/m/Y H:i') }}</div>
            <div><strong>Total:</strong> {{ number_format($compra->total, 2) }}</div>
        </div>
        <table class="mt-6 min-w-full divide-y divide-gray-200">
            <thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Producto</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Cantidad</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Precio</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Subtotal</th></tr></thead>
            <tbody class="divide-y divide-gray-200">@foreach ($compra->detalles as $detalle)<tr><td class="px-4 py-3 text-sm">{{ $detalle->producto->nombre }}</td><td class="px-4 py-3 text-sm">{{ $detalle->cantidad }}</td><td class="px-4 py-3 text-sm">{{ number_format($detalle->precio_compra, 2) }}</td><td class="px-4 py-3 text-sm">{{ number_format($detalle->subtotal, 2) }}</td></tr>@endforeach</tbody>
        </table>
        <div class="mt-6"><a href="{{ route('compras.index') }}" class="text-sm text-gray-600">Volver al listado</a></div>
    </div></div></div></div>
</x-app-layout>
