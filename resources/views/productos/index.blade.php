<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Productos
            </h2>

            @can('productos.crear')
                <a href="{{ route('productos.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Nuevo producto
                </a>
            @endcan
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 rounded-md bg-green-50 p-4 text-sm text-green-700">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Codigo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Categoria</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Proveedor</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Precio venta</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Stock</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($productos as $producto)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $producto->codigo_barra }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $producto->nombre }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $producto->categoria->nombre }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $producto->proveedor?->nombre ?? 'Sin proveedor' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ number_format($producto->precio_venta, 2) }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $producto->stock }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $producto->estado ? 'Activo' : 'Inactivo' }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('productos.show', $producto) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                                @can('productos.editar')
                                                    <a href="{{ route('productos.edit', $producto) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                                @endcan
                                                @can('productos.eliminar')
                                                    <form method="POST" action="{{ route('productos.destroy', $producto) }}" onsubmit="return confirm('¿Eliminar este producto?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                                    </form>
                                                @endcan
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="px-4 py-6 text-center text-sm text-gray-500">
                                            No hay productos registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $productos->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
