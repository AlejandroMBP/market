<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Registrar compra</h2></x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('compras.store') }}" class="space-y-6">
                        @csrf
                        <div class="grid gap-6 sm:grid-cols-4">
                            <div>
                                <x-input-label for="proveedor_id" value="Proveedor" />
                                <select id="proveedor_id" name="proveedor_id" required class="mt-1 block w-full rounded-md border-gray-300">
                                    @foreach ($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id }}" @selected(old('proveedor_id') == $proveedor->id)>{{ $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                                <x-input-error class="mt-2" :messages="$errors->get('proveedor_id')" />
                            </div>
                            <div>
                                <x-input-label for="fecha" value="Fecha" />
                                <x-text-input id="fecha" name="fecha" type="datetime-local" class="mt-1 block w-full" :value="old('fecha', now()->format('Y-m-d\\TH:i'))" required />
                            </div>
                            <div>
                                <x-input-label for="tipo_comprobante" value="Tipo comprobante" />
                                <x-text-input id="tipo_comprobante" name="tipo_comprobante" class="mt-1 block w-full" :value="old('tipo_comprobante')" />
                            </div>
                            <div>
                                <x-input-label for="numero_comprobante" value="Numero" />
                                <x-text-input id="numero_comprobante" name="numero_comprobante" class="mt-1 block w-full" :value="old('numero_comprobante')" />
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead><tr>
                                    <th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Producto</th>
                                    <th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Cantidad</th>
                                    <th class="px-3 py-2 text-left text-xs text-gray-500 uppercase">Precio compra</th>
                                </tr></thead>
                                <tbody class="divide-y divide-gray-200">
                                    @for ($i = 0; $i < 5; $i++)
                                        <tr>
                                            <td class="px-3 py-2">
                                                <select name="productos[{{ $i }}][producto_id]" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif>
                                                    <option value="">Seleccione</option>
                                                    @foreach ($productos as $producto)
                                                        <option value="{{ $producto->id }}">{{ $producto->nombre }}</option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td class="px-3 py-2"><input name="productos[{{ $i }}][cantidad]" type="number" min="1" value="{{ $i === 0 ? 1 : '' }}" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif></td>
                                            <td class="px-3 py-2"><input name="productos[{{ $i }}][precio_compra]" type="number" step="0.01" min="0" class="block w-full rounded-md border-gray-300" @if($i === 0) required @endif></td>
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>

                        <div class="grid gap-6 sm:grid-cols-2">
                            <div>
                                <x-input-label for="descuento" value="Descuento" />
                                <x-text-input id="descuento" name="descuento" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('descuento', 0)" required />
                            </div>
                            <div>
                                <x-input-label for="observacion" value="Observacion" />
                                <x-text-input id="observacion" name="observacion" class="mt-1 block w-full" :value="old('observacion')" />
                            </div>
                        </div>

                        <x-input-error class="mt-2" :messages="$errors->get('productos')" />
                        <div class="flex gap-4"><x-primary-button>Guardar</x-primary-button><a href="{{ route('compras.index') }}" class="text-sm text-gray-600">Cancelar</a></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
