<div class="space-y-6">
    <div>
        <x-input-label for="nombre" value="Nombre" />
        <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $proveedor->nombre ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
    </div>

    <div class="grid gap-6 sm:grid-cols-3">
        <div>
            <x-input-label for="nit" value="NIT" />
            <x-text-input id="nit" name="nit" type="text" class="mt-1 block w-full" :value="old('nit', $proveedor->nit ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('nit')" />
        </div>

        <div>
            <x-input-label for="telefono" value="Telefono" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $proveedor->telefono ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <div>
            <x-input-label for="correo" value="Correo" />
            <x-text-input id="correo" name="correo" type="email" class="mt-1 block w-full" :value="old('correo', $proveedor->correo ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('correo')" />
        </div>
    </div>

    <div>
        <x-input-label for="direccion" value="Direccion" />
        <textarea id="direccion" name="direccion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('direccion', $proveedor->direccion ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
    </div>

    <div>
        <x-input-label for="estado" value="Estado" />
        <select id="estado" name="estado" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="1" @selected((string) old('estado', isset($proveedor) ? (int) $proveedor->estado : 1) === '1')>Activo</option>
            <option value="0" @selected((string) old('estado', isset($proveedor) ? (int) $proveedor->estado : 1) === '0')>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $textoBoton }}
        </x-primary-button>

        <a href="{{ route('proveedores.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
