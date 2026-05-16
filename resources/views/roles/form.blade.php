<div>
    <div>
        <x-input-label for="name" value="Nombre del rol"/>
        <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name',$role->name ?? '')" required autofocus/>
        <x-input-error class="mt-2" :messages="$errors->get('name')"/>
    </div>
        <x-input-label value="Permisos"/>
        <x-input-error class="mt-2" :messages="$errors->get('permissions')"/>
        <div>
            @foreach ($permissions as $permission)
                <label class="flex items-center">
                    <input
                        type="checkbox"
                        name="permissions[]"
                        value="{{ $permission->name}}"
                        @checked(in_array($permission->name, old('permissions', isset($role) ? $roles->permissions->pluck('name')->toArray() : [] )))
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                    >
                </label>
            @endforeach
        </div>
</div>
