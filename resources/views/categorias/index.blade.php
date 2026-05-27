<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categorias
            </h2>

            @can('categorias.crear')
                <a href="{{ route('categorias.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    Nueva categoria
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
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descripcion</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($categorias as $categoria)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $categoria->id }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $categoria->nombre }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $categoria->descripcion ?? 'Sin descripcion' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $categoria->estado ? 'Activo' : 'Inactivo' }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('categorias.show', $categoria) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                                @can('categorias.editar')
                                                    <a href="{{ route('categorias.edit', $categoria) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                                @endcan
                                                @can('categorias.eliminar')
                                                    <form method="POST" action="{{ route('categorias.destroy', $categoria) }}" onsubmit="return confirm('¿Eliminar esta categoria?')">
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
                                        <td colspan="5" class="px-4 py-6 text-center text-sm text-gray-500">
                                            No hay categorias registradas.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $categorias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
