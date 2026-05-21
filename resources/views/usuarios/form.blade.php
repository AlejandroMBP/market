<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Nombre" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $usuario->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label for="email" value="Email" />
        <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $usuario->email ?? '')" required />
        <x-input-error class="mt-2" :messages="$errors->get('email')" />
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="telefono" value="Telefono" />
            <x-text-input id="telefono" name="telefono" type="text" class="mt-1 block w-full" :value="old('telefono', $usuario->telefono ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('telefono')" />
        </div>

        <div>
            <x-input-label for="foto" value="Foto" />
            <x-text-input id="foto" name="foto" type="text" class="mt-1 block w-full" :value="old('foto', $usuario->foto ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('foto')" />
        </div>
    </div>

    <div>
        <x-input-label for="direccion" value="Direccion" />
        <textarea id="direccion" name="direccion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('direccion', $usuario->direccion ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('direccion')" />
    </div>

    <div>
        <x-input-label for="password" value="Contraseña" />
        <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" :required="! isset($usuario)" autocomplete="new-password" />
        <x-input-error class="mt-2" :messages="$errors->get('password')" />

        @isset($usuario)
            <p class="mt-2 text-sm text-gray-500">Deja este campo vacio si no quieres cambiar la contraseña.</p>
        @endisset
    </div>

    <div>
        <x-input-label for="password_confirmation" value="Confirmar contraseña" />
        <x-text-input id="password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" :required="! isset($usuario)" autocomplete="new-password" />
    </div>

    <div>
        <x-input-label for="role" value="Rol" />
        <select id="role" name="role" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="">Seleccione un rol</option>
            @foreach ($roles as $role)
                <option value="{{ $role->name }}" @selected(old('role', isset($usuario) ? $usuario->roles->first()?->name : '') === $role->name)>
                    {{ $role->name }}
                </option>
            @endforeach
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('role')" />
    </div>

    <div>
        <x-input-label for="estado" value="Estado" />
        <select id="estado" name="estado" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="1" @selected((string) old('estado', isset($usuario) ? (int) $usuario->estado : 1) === '1')>Activo</option>
            <option value="0" @selected((string) old('estado', isset($usuario) ? (int) $usuario->estado : 1) === '0')>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $textoBoton }}
        </x-primary-button>

        <a href="{{ route('usuarios.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
