<div class="space-y-6">
    <div>
        <x-input-label for="name" value="Nombre del rol" />
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $role->name ?? '')" required autofocus />
        <x-input-error class="mt-2" :messages="$errors->get('name')" />
    </div>

    <div>
        <x-input-label value="Permisos" />
        <x-input-error class="mt-2" :messages="$errors->get('permissions')" />

        <div class="mt-3 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($permissions as $permission)
                <label class="flex items-center gap-2 rounded-md border border-gray-200 px-3 py-2 text-sm text-gray-700">
                    <input
                        type="checkbox"
                        name="permissions[]"
                        value="{{ $permission->name }}"
                        @checked(in_array($permission->name, old('permissions', isset($role) ? $role->permissions->pluck('name')->toArray() : [])))
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    >
                    <span>{{ $permission->name }}</span>
                </label>
            @endforeach
        </div>
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $textoBoton }}
        </x-primary-button>

        <a href="{{ route('roles.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
