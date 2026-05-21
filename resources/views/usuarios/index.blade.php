<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Usuarios
            </h2>

            <a href="{{ route('usuarios.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                Nuevo usuario
            </a>
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
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Direccion</th>
                                    <th class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase">Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($usuarios as $usuario)
                                    <tr>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $usuario->id }}</td>
                                        <td class="px-4 py-3 text-sm font-medium text-gray-900">{{ $usuario->name }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $usuario->email }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $usuario->roles->pluck('name')->join(', ') ?: 'Sin rol' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $usuario->estado ? 'Activo' : 'Inactivo' }}</td>
                                        <td class="px-4 py-3 text-sm text-gray-700">{{ $usuario->direccion ?: 'Sin direccion' }}</td>
                                        <td class="px-4 py-3 text-right text-sm">
                                            <div class="flex justify-end gap-3">
                                                <a href="{{ route('usuarios.show', $usuario) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                                <a href="{{ route('usuarios.edit', $usuario) }}" class="text-yellow-600 hover:text-yellow-900">Editar</a>
                                                <form method="POST" action="{{ route('usuarios.destroy', $usuario) }}" onsubmit="return confirm('¿Eliminar este usuario?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="px-4 py-6 text-center text-sm text-gray-500">
                                            No hay usuarios registrados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $usuarios->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
