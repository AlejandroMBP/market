<x-app-layout>
    <x-slot name="header"><h2 class="font-semibold text-xl text-gray-800 leading-tight">Abrir caja</h2></x-slot>
    <div class="py-12"><div class="max-w-3xl mx-auto sm:px-6 lg:px-8"><div class="bg-white shadow-sm sm:rounded-lg"><div class="p-6">
        <form method="POST" action="{{ route('cajas.store') }}" class="space-y-6">@csrf
            <div><x-input-label for="fecha_apertura" value="Fecha apertura" /><x-text-input id="fecha_apertura" name="fecha_apertura" type="datetime-local" class="mt-1 block w-full" :value="old('fecha_apertura', now()->format('Y-m-d\\TH:i'))" required /></div>
            <div><x-input-label for="monto_inicial" value="Monto inicial" /><x-text-input id="monto_inicial" name="monto_inicial" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('monto_inicial', 0)" required /></div>
            <div><x-input-label for="observacion" value="Observacion" /><textarea id="observacion" name="observacion" rows="3" class="mt-1 block w-full rounded-md border-gray-300">{{ old('observacion') }}</textarea></div>
            <div class="flex gap-4"><x-primary-button>Guardar</x-primary-button><a href="{{ route('cajas.index') }}" class="text-sm text-gray-600">Cancelar</a></div>
        </form>
    </div></div></div></div>
</x-app-layout>
