<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Ventas</h2>
            @can('ventas.crear')
                <a href="{{ route('ventas.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase">Nueva venta</a>
            @endcan
        </div>
    </x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @if (session('success'))<div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>@endif
        <div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6 overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Fecha</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Cliente</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Metodo</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Total</th><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Estado</th><th class="px-4 py-3 text-right text-xs text-gray-500 uppercase">Acciones</th></tr></thead>
                <tbody class="divide-y divide-gray-200">@forelse ($ventas as $venta)<tr>
                    <td class="px-4 py-3 text-sm">{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                    <td class="px-4 py-3 text-sm">{{ $venta->cliente_nombre ?? $venta->cliente_documento ?? 'Sin datos' }}</td>
                    <td class="px-4 py-3 text-sm">{{ $venta->metodo_pago }}</td>
                    <td class="px-4 py-3 text-sm">{{ number_format($venta->total, 2) }}</td>
                    <td class="px-4 py-3 text-sm">{{ $venta->estado }}</td>
                    <td class="px-4 py-3 text-right text-sm"><div class="flex justify-end gap-3"><a href="{{ route('ventas.show', $venta) }}" class="text-indigo-600">Ver</a>@can('ventas.eliminar')<form method="POST" action="{{ route('ventas.destroy', $venta) }}" onsubmit="return confirm('¿Anular esta venta?')">@csrf @method('DELETE')<button class="text-red-600">Anular</button></form>@endcan</div></td>
                </tr>@empty<tr><td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">No hay ventas registradas.</td></tr>@endforelse</tbody>
            </table>
            <div class="mt-6">{{ $ventas->links() }}</div>
        </div></div>
    </div></div>
</x-app-layout>
