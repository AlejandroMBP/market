<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Roles
            </h2>
            <a href="{{ route('roles.create')}}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-white text-sm uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700">
                Nuevo rol
            </a>
        </div>
    </x-slot>
<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead>
                    <tr>
                        <th class="px4 py-3 text-left text-xs font-medium text-gray-500 uppercase">#</th>
                        <th class="px4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                        <th class="px4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Permisos</th>
                        <th class="px4 py-3 text-left text-xs font-medium text-gray-500 uppercase">acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <tr>
                        <td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No hay roles registrados</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</x-app-layout>
