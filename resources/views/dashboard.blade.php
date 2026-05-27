<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @can('dashboard.admin')
                <div class="mb-6">
                    <h3 class="text-2xl font-semibold text-gray-900">Panel de administrador</h3>
                    <p class="mt-1 text-sm text-gray-600">Resumen operativo del minimarket para el dia de hoy.</p>
                </div>

                {{-- <div class="mb-6 bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div>
                            <h4 class="font-semibold text-gray-900">Reportes</h4>
                            <p class="mt-1 text-sm text-gray-600">Exporta reportes PDF.</p>
                        </div>

                        <div class="flex flex-wrap gap-3">
                            <a href="{{ route('reportes.index') }}" class="inline-flex items-center rounded-md border border-gray-300 px-4 py-2 text-xs font-semibold uppercase text-gray-700 hover:bg-gray-50">Ir a reportes</a>
                        </div>
                    </div>
                </div> --}}

                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="text-sm font-medium text-gray-500">Ventas hoy</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($ventasHoy, 2) }}</div>
                    </div>

                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="text-sm font-medium text-gray-500">Compras hoy</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($comprasHoy, 2) }}</div>
                    </div>

                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="text-sm font-medium text-gray-500">Ganancia estimada</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ number_format($gananciaEstimadaHoy, 2) }}</div>
                    </div>

                    <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                        <div class="text-sm font-medium text-gray-500">Cajas abiertas</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $cajasAbiertas }}</div>
                    </div>
                </div>

                <div class="mt-6 grid gap-4 sm:grid-cols-3">
                    <a href="{{ route('productos.index') }}" class="bg-white p-6 shadow-sm sm:rounded-lg hover:bg-gray-50">
                        <div class="text-sm font-medium text-gray-500">Productos activos</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $productosActivos }}</div>
                    </a>

                    {{-- <a href="{{ route('reportes.index') }}" class="bg-white p-6 shadow-sm sm:rounded-lg hover:bg-gray-50">
                        <div class="text-sm font-medium text-gray-500">Productos bajo stock</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $productosBajoStock }}</div>
                    </a> --}}

                    <a href="{{ route('usuarios.index') }}" class="bg-white p-6 shadow-sm sm:rounded-lg hover:bg-gray-50">
                        <div class="text-sm font-medium text-gray-500">Usuarios activos</div>
                        <div class="mt-2 text-2xl font-semibold text-gray-900">{{ $usuariosActivos }}</div>
                    </a>
                </div>

                <div class="mt-6 grid gap-6 lg:grid-cols-2">
                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 p-6">
                            <h4 class="font-semibold text-gray-900">Ultimas ventas</h4>
                        </div>
                        <div class="p-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium uppercase text-gray-500">Fecha</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium uppercase text-gray-500">Usuario</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium uppercase text-gray-500">Total</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($ultimasVentas as $venta)
                                        <tr>
                                            <td class="px-3 py-2 text-sm text-gray-700">{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-700">{{ $venta->user->name }}</td>
                                            <td class="px-3 py-2 text-right text-sm text-gray-700">{{ number_format($venta->total, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-6 text-center text-sm text-gray-500">No hay ventas registradas.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="bg-white shadow-sm sm:rounded-lg">
                        <div class="border-b border-gray-200 p-6">
                            <h4 class="font-semibold text-gray-900">Productos criticos</h4>
                        </div>
                        <div class="p-6 overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th class="px-3 py-2 text-left text-xs font-medium uppercase text-gray-500">Producto</th>
                                        <th class="px-3 py-2 text-left text-xs font-medium uppercase text-gray-500">Categoria</th>
                                        <th class="px-3 py-2 text-right text-xs font-medium uppercase text-gray-500">Stock</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($productosCriticos as $producto)
                                        <tr>
                                            <td class="px-3 py-2 text-sm text-gray-700">{{ $producto->nombre }}</td>
                                            <td class="px-3 py-2 text-sm text-gray-700">{{ $producto->categoria->nombre }}</td>
                                            <td class="px-3 py-2 text-right text-sm text-gray-700">{{ $producto->stock }} / {{ $producto->stock_minimo }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="px-3 py-6 text-center text-sm text-gray-500">No hay productos criticos.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-8 text-gray-900">
                        <h3 class="text-2xl font-semibold text-gray-900">
                            Bienvenido {{ Auth::user()->name }} a Minimarket
                        </h3>
                        <p class="mt-2 text-sm text-gray-600">
                            Usa la barra de navegacion para acceder a los modulos disponibles para tu rol.
                        </p>
                    </div>
                </div>
            @endcan
        </div>
    </div>
</x-app-layout>
