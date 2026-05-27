<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Registrar venta</h2></x-slot>
    <div class="py-12"><div class="max-w-7xl mx-auto sm:px-6 lg:px-8"><div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
        @if (! $cajaAbierta)
            <div class="mb-6 rounded-md bg-yellow-50 p-4 text-sm text-yellow-800">
                Debes abrir una caja antes de registrar ventas.
                <a href="{{ route('cajas.create') }}" class="font-semibold underline">Abrir caja</a>
            </div>
        @else
            <div class="mb-6 rounded-md bg-green-50 p-4 text-sm text-green-800">
                Caja abierta desde {{ $cajaAbierta->fecha_apertura->format('d/m/Y H:i') }} con monto inicial {{ number_format($cajaAbierta->monto_inicial, 2) }}.
            </div>
        @endif

        <form method="POST" action="{{ route('ventas.store') }}" class="space-y-6">
            @csrf
            <div class="grid gap-6 sm:grid-cols-3">
                <div><x-input-label for="fecha" value="Fecha" /><x-text-input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" :value="old('fecha', now()->format('Y-m-d\\TH:i'))" required /></div>
                <div>
                    <x-input-label for="metodo_pago_id" value="Metodo de pago" />
                    <select id="metodo_pago_id" name="metodo_pago_id" class="mt-1 block w-full rounded-md border-gray-300" required>
                        <option value="">Seleccione</option>
                        @foreach ($metodosPago as $metodoPago)
                            <option value="{{ $metodoPago->id }}" @selected(old('metodo_pago_id') == $metodoPago->id)>{{ $metodoPago->nombre }}</option>
                        @endforeach
                    </select>
                    <x-input-error class="mt-2" :messages="$errors->get('metodo_pago_id')" />
                </div>
                <div><x-input-label for="monto_pagado" value="Monto pagado" /><x-text-input id="monto_pagado" name="monto_pagado" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('monto_pagado', 0)" required /></div>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <div><x-input-label for="cliente_documento" value="NIT o CI" /><x-text-input id="cliente_documento" name="cliente_documento" class="mt-1 block w-full" :value="old('cliente_documento')" /></div>
                <div><x-input-label for="cliente_nombre" value="Nombre del cliente" /><x-text-input id="cliente_nombre" name="cliente_nombre" class="mt-1 block w-full" :value="old('cliente_nombre')" /></div>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead><tr><th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Producto</th><th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Cantidad</th><th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Precio venta</th><th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Descuento</th></tr></thead>
                    <tbody class="divide-y divide-gray-200">
                        @for ($i = 0; $i < 5; $i++)
                            <tr>
                                <td class="px-3 py-2"><select name="productos[{{ $i }}][producto_id]" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif><option value="">Seleccione</option>@foreach ($productos as $producto)<option value="{{ $producto->id }}">{{ $producto->nombre }} | Stock: {{ $producto->stock }} | {{ number_format($producto->precio_venta, 2) }}</option>@endforeach</select></td>
                                <td class="px-3 py-2"><input name="productos[{{ $i }}][cantidad]" type="number" min="1" value="{{ $i === 0 ? 1 : '' }}" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif></td>
                                <td class="px-3 py-2"><input name="productos[{{ $i }}][precio_venta]" type="number" step="0.01" min="0" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif></td>
                                <td class="px-3 py-2"><input name="productos[{{ $i }}][descuento]" type="number" step="0.01" min="0" value="0" class="block w-full rounded-md border-gray-300"></td>
                            </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
            <div class="grid gap-6 sm:grid-cols-2">
                <div><x-input-label for="descuento" value="Descuento general" /><x-text-input id="descuento" name="descuento" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('descuento', 0)" required /></div>
                <div><x-input-label for="observacion" value="Observacion" /><x-text-input id="observacion" name="observacion" class="mt-1 block w-full" :value="old('observacion')" /></div>
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('productos')" />
            <div class="flex gap-4">
                <x-primary-button :disabled="! $cajaAbierta">Guardar</x-primary-button>
                <a href="{{ route('ventas.index') }}" class="text-sm text-gray-600">Cancelar</a>
            </div>
        </form>
    </div></div></div></div>
</x-app-layout>
