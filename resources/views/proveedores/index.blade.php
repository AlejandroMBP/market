<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Proveedores
            </h2>

            @can('proveedores.crear')
                <a href="{{ route('proveedores.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Nuevo proveedor
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
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">NIT</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Telefono</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Correo</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($proveedores as $proveedor)
                                    <tr>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $proveedor->nombre }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proveedor->nit ?? 'Sin NIT' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proveedor->telefono ?? 'Sin telefono' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proveedor->correo ?? 'Sin correo' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $proveedor->estado ? 'Activo' : 'Inactivo' }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('proveedores.show', $proveedor) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                                @can('proveedores.editar')
                                                    <a href="{{ route('proveedores.edit', $proveedor) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                                @endcan
                                                @can('proveedores.eliminar')
                                                    <form method="POST" action="{{ route('proveedores.destroy', $proveedor) }}" onsubmit="return confirm('¿Eliminar este proveedor?')">
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
                                        <td colspan="6" class="px-4 py-6 text-center text-sm text-gray-500">
                                            No hay proveedores registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $proveedores->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
