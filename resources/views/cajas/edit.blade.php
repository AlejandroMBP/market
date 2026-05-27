<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Editar caja</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
        <form method="POST" action="{{ route('cajas.update', $caja) }}" class="space-y-6">@csrf @method('PUT')
            <div><x-input-label for="fecha_cierre" value="Fecha cierre" /><x-text-input id="fecha_cierre" name="fecha_cierre" type="datetime-local" class="mt-1 block w-full" :value="old('fecha_cierre', $caja->fecha_cierre?->format('Y-m-d\\TH:i'))" /></div>
            <div><x-input-label for="monto_final" value="Monto final" /><x-text-input id="monto_final" name="monto_final" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('monto_final', $caja->monto_final)" /></div>
            <div><x-input-label for="estado" value="Estado" /><select id="estado" name="estado" class="mt-1 block w-full rounded-md border-gray-300"><option value="abierta" @selected(old('estado', $caja->estado) === 'abierta')>abierta</option><option value="cerrada" @selected(old('estado', $caja->estado) === 'cerrada')>cerrada</option></select></div>
            <div><x-input-label for="observacion" value="Observacion" /><textarea id="observacion" name="observacion" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ old('observacion', $caja->observacion) }}</textarea></div>
            <div class="flex gap-4"><x-primary-button>Actualizar</x-primary-button><a href="{{ route('cajas.index') }}" class="text-sm text-gray-600">Cancelar</a></div>
        </form>
    </div></div></div></div>
</x-app-layout>
