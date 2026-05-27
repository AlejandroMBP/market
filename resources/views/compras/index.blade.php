<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Compras</h2>
            @can('compras.crear')
                <a href="{{ route('compras.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 rounded-md font-semibold text-xs text-white uppercase">Nueva compra</a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))<div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">{{ session('success') }}</div>@endif
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead><tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Fecha</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proveedor</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Total</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr></thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($compras as $compra)
                                <tr>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $compra->fecha->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $compra->proveedor->nombre }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ number_format($compra->total, 2) }}</td>
                                    <td class="px-4 py-3 text-sm text-gray-700">{{ $compra->estado }}</td>
                                    <td class="px-4 py-3 text-right text-sm">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('compras.show', $compra) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                            @can('compras.eliminar')
                                                <form method="POST" action="{{ route('compras.destroy', $compra) }}" onsubmit="return confirm('¿Anular esta compra?')">
                                                    @csrf @method('DELETE')
                                                    <button class="text-red-600 hover:text-red-900">Anular</button>
                                                </form>
                                            @endcan
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr><td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">No hay compras registradas.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                    <div class="mt-6">{{ $compras->links() }}</div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
