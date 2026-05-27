<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Reportes</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
            <form method="GET" action="{{ route('reportes.index') }}" class="grid gap-4 sm:grid-cols-3">
                <div><x-input-label for="fecha_inicio" value="Desde" /><x-text-input id="fecha_inicio" name="fecha_inicio" type="date" class="mt-1 block w-full" :value="$fechaInicio" /></div>
                <div><x-input-label for="fecha_fin" value="Hasta" /><x-text-input id="fecha_fin" name="fecha_fin" type="date" class="mt-1 block w-full" :value="$fechaFin" /></div>
                <div class="flex items-end"><x-primary-button>Filtrar</x-primary-button></div>
            </form>
            <div class="mt-4 flex flex-wrap gap-3">
                <a href="{{ route('reportes.general.pdf', request()->only(['fecha_inicio', 'fecha_fin'])) }}" class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase text-white">PDF general</a>
                <a href="{{ route('reportes.ventas.pdf', request()->only(['fecha_inicio', 'fecha_fin'])) }}" class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase text-white">PDF ventas</a>
                <a href="{{ route('reportes.compras.pdf', request()->only(['fecha_inicio', 'fecha_fin'])) }}" class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase text-white">PDF compras</a>
                <a href="{{ route('reportes.inventario.pdf', request()->only(['fecha_inicio', 'fecha_fin'])) }}" class="inline-flex items-center rounded-md bg-gray-800 px-4 py-2 text-xs font-semibold uppercase text-white">PDF inventario</a>
            </div>
        </div></div>

        <div class="grid gap-4 sm:grid-cols-3">
            <div class="bg-white p-6 shadow-sm sm:rounded-lg"><div class="text-sm text-gray-500">Total ventas</div><div class="mt-2 text-2xl font-semibold">{{ number_format($totalVentas, 2) }}</div></div>
            <div class="bg-white p-6 shadow-sm sm:rounded-lg"><div class="text-sm text-gray-500">Total compras</div><div class="mt-2 text-2xl font-semibold">{{ number_format($totalCompras, 2) }}</div></div>
            <div class="bg-white p-6 shadow-sm sm:rounded-lg"><div class="text-sm text-gray-500">Ganancia estimada</div><div class="mt-2 text-2xl font-semibold">{{ number_format($totalVentas - $totalCompras, 2) }}</div></div>
        </div>

        <div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6 overflow-x-auto">
            <h3 class="mb-4 text-lg font-semibold">Ventas</h3>
            <table class="min-w-full divide-y divide-gray-200"><thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Fecha</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Metodo</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Total</th></tr></thead><tbody class="divide-y divide-gray-200">@forelse ($ventas as $venta)<tr><td class="px-4 py-3 text-sm">{{ $venta->fecha->format('d/m/Y H:i') }}</td><td class="px-4 py-3 text-sm">{{ $venta->metodo_pago }}</td><td class="px-4 py-3 text-sm">{{ number_format($venta->total, 2) }}</td></tr>@empty<tr><td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">Sin ventas.</td></tr>@endforelse</tbody></table>
        </div></div>

        <div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6 overflow-x-auto">
            <h3 class="mb-4 text-lg font-semibold">Compras</h3>
            <table class="min-w-full divide-y divide-gray-200"><thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Fecha</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Proveedor</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Total</th></tr></thead><tbody class="divide-y divide-gray-200">@forelse ($compras as $compra)<tr><td class="px-4 py-3 text-sm">{{ $compra->fecha->format('d/m/Y H:i') }}</td><td class="px-4 py-3 text-sm">{{ $compra->proveedor->nombre }}</td><td class="px-4 py-3 text-sm">{{ number_format($compra->total, 2) }}</td></tr>@empty<tr><td colspan="3" class="px-4 py-6 text-center text-sm text-gray-500">Sin compras.</td></tr>@endforelse</tbody></table>
        </div></div>

        <div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6 overflow-x-auto">
            <h3 class="mb-4 text-lg font-semibold">Productos con bajo stock</h3>
            <table class="min-w-full divide-y divide-gray-200"><thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Producto</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Categoria</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Stock</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Minimo</th></tr></thead><tbody class="divide-y divide-gray-200">@forelse ($productosBajoStock as $producto)<tr><td class="px-4 py-3 text-sm">{{ $producto->nombre }}</td><td class="px-4 py-3 text-sm">{{ $producto->categoria->nombre }}</td><td class="px-4 py-3 text-sm">{{ $producto->stock }}</td><td class="px-4 py-3 text-sm">{{ $producto->stock_minimo }}</td></tr>@empty<tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No hay productos con bajo stock.</td></tr>@endforelse</tbody></table>
        </div></div>
    </div></div>
</x-app-layout>
