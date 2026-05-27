<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Detalle de caja</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4 text-sm">
                        <div><strong>Usuario:</strong> {{ $caja->user->name }}</div>
                        <div><strong>Apertura:</strong> {{ $caja->fecha_apertura->format('d/m/Y H:i') }}</div>
                        <div><strong>Cierre:</strong> {{ $caja->fecha_cierre?->format('d/m/Y H:i') ?? '-' }}</div>
                        <div><strong>Estado:</strong> {{ $caja->estado }}</div>
                    </div>
                    <div class="mt-4 text-sm"><strong>Observacion:</strong> {{ $caja->observacion ?? '-' }}</div>
                </div>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="text-sm text-gray-500">Monto inicial</div>
                    <div class="mt-2 text-2xl font-semibold">{{ number_format($caja->monto_inicial, 2) }}</div>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="text-sm text-gray-500">Ventas de la caja</div>
                    <div class="mt-2 text-2xl font-semibold">{{ number_format($totalVentas, 2) }}</div>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="text-sm text-gray-500">Monto esperado</div>
                    <div class="mt-2 text-2xl font-semibold">{{ number_format($montoEsperado, 2) }}</div>
                </div>
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <div class="text-sm text-gray-500">Diferencia</div>
                    <div class="mt-2 text-2xl font-semibold">{{ $diferencia === null ? '-' : number_format($diferencia, 2) }}</div>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-2">
                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900">Ventas por metodo de pago</h3>
                    </div>
                    <div class="p-6">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead><tr><th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Metodo</th><th class="px-4 py-3 text-right text-xs text-gray-500 uppercase">Total</th></tr></thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($ventasPorMetodo as $metodo => $total)
                                    <tr><td class="px-4 py-3 text-sm">{{ $metodo }}</td><td class="px-4 py-3 text-right text-sm">{{ number_format($total, 2) }}</td></tr>
                                @empty
                                    <tr><td colspan="2" class="px-4 py-6 text-center text-sm text-gray-500">Sin ventas registradas.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="bg-white shadow-sm sm:rounded-lg">
                    <div class="border-b border-gray-200 p-6">
                        <h3 class="font-semibold text-gray-900">Cierre</h3>
                    </div>
                    <div class="p-6 text-sm space-y-3">
                        <p><strong>Monto final contado:</strong> {{ $caja->monto_final === null ? '-' : number_format($caja->monto_final, 2) }}</p>
                        <p><strong>Calculo:</strong> monto inicial + ventas de caja = monto esperado.</p>
                        <p class="text-gray-600">La diferencia compara el monto final contado contra el monto esperado.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="border-b border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900">Ventas asociadas</h3>
                </div>
                <div class="p-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead>
                            <tr>
                                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Fecha</th>
                                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Cliente</th>
                                <th class="px-4 py-3 text-left text-xs text-gray-500 uppercase">Metodo</th>
                                <th class="px-4 py-3 text-right text-xs text-gray-500 uppercase">Total</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @forelse ($caja->ventas as $venta)
                                <tr>
                                    <td class="px-4 py-3 text-sm">{{ $venta->fecha->format('d/m/Y H:i') }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $venta->cliente_nombre ?? $venta->cliente_documento ?? 'Sin datos' }}</td>
                                    <td class="px-4 py-3 text-sm">{{ $venta->metodo_pago }}</td>
                                    <td class="px-4 py-3 text-right text-sm">{{ number_format($venta->total, 2) }}</td>
                                </tr>
                            @empty
                                <tr><td colspan="4" class="px-4 py-6 text-center text-sm text-gray-500">No hay ventas para esta caja.</td></tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <a href="{{ route('cajas.index') }}" class="text-sm text-gray-600">Volver al listado</a>
        </div>
    </div>
</x-app-layout>
