<div class="space-y-6">
    <div>
        <x-input-label for="nombre" value="Nombre" />
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $categoria->nombre ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
    </div>

    <div>
        <x-input-label for="descripcion" value="Descripcion" />
        <x-text-input id="descripcion" name="descripcion" type="text" class="mt-1 block w-full" :value="old('descripcion', $categoria->descripcion ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
    </div>

    <div>
        <x-input-label for="estado" value="Estado" />
        <select id="estado" name="estado" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="1" @selected((string) old('estado', isset($categoria) ? (int) $categoria->estado : 1) === '1')>Activo</option>
            <option value="0" @selected((string) old('estado', isset($categoria) ? (int) $categoria->estado : 1) === '0')>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $textoBoton }}
        </x-primary-button>

        <a href="{{ route('categorias.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
