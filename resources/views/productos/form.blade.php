<div class="space-y-6">
    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="codigo_barra" value="Codigo de barra" />
            <x-text-input id="codigo_barra" name="codigo_barra" type="text" class="mt-1 block w-full" :value="old('codigo_barra', $producto->codigo_barra ?? '')" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('codigo_barra')" />
        </div>

        <div>
            <x-input-label for="nombre" value="Nombre" />
            <x-text-input id="nombre" name="nombre" type="text" class="mt-1 block w-full" :value="old('nombre', $producto->nombre ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('nombre')" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="categoria_id" value="Categoria" />
            <select id="categoria_id" name="categoria_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Seleccione una categoria</option>
                @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" @selected((int) old('categoria_id', $producto->categoria_id ?? 0) === $categoria->id)>
                        {{ $categoria->nombre }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('categoria_id')" />
        </div>

        <div>
            <x-input-label for="proveedor_id" value="Proveedor" />
            <select id="proveedor_id" name="proveedor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Sin proveedor</option>
                @foreach ($proveedores as $proveedor)
                    <option value="{{ $proveedor->id }}" @selected((int) old('proveedor_id', $producto->proveedor_id ?? 0) === $proveedor->id)>
                        {{ $proveedor->nombre }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('proveedor_id')" />
        </div>
    </div>

    <div>
        <x-input-label for="descripcion" value="Descripcion" />
        <textarea id="descripcion" name="descripcion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>
        <x-input-error class="mt-2" :messages="$errors->get('descripcion')" />
    </div>

    <div class="grid gap-6 sm:grid-cols-4">
        <div>
            <x-input-label for="precio_compra" value="Precio compra" />
            <x-text-input id="precio_compra" name="precio_compra" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('precio_compra', $producto->precio_compra ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('precio_compra')" />
        </div>

        <div>
            <x-input-label for="precio_venta" value="Precio venta" />
            <x-text-input id="precio_venta" name="precio_venta" type="number" step="0.01" min="0" class="mt-1 block w-full" :value="old('precio_venta', $producto->precio_venta ?? '')" required />
            <x-input-error class="mt-2" :messages="$errors->get('precio_venta')" />
        </div>

        <div>
            <x-input-label for="stock" value="Stock" />
            <x-text-input id="stock" name="stock" type="number" min="0" class="mt-1 block w-full" :value="old('stock', $producto->stock ?? 0)" required />
            <x-input-error class="mt-2" :messages="$errors->get('stock')" />
        </div>

        <div>
            <x-input-label for="stock_minimo" value="Stock minimo" />
            <x-text-input id="stock_minimo" name="stock_minimo" type="number" min="0" class="mt-1 block w-full" :value="old('stock_minimo', $producto->stock_minimo ?? 5)" required />
            <x-input-error class="mt-2" :messages="$errors->get('stock_minimo')" />
        </div>
    </div>

    <div class="grid gap-6 sm:grid-cols-2">
        <div>
            <x-input-label for="unidad_medida" value="Unidad de medida" />
            <x-text-input id="unidad_medida" name="unidad_medida" type="text" class="mt-1 block w-full" :value="old('unidad_medida', $producto->unidad_medida ?? 'unidad')" required />
            <x-input-error class="mt-2" :messages="$errors->get('unidad_medida')" />
        </div>

        <div>
            <x-input-label for="imagen" value="Imagen" />
            <x-text-input id="imagen" name="imagen" type="text" class="mt-1 block w-full" :value="old('imagen', $producto->imagen ?? '')" />
            <x-input-error class="mt-2" :messages="$errors->get('imagen')" />
        </div>
    </div>

    <div>
        <x-input-label for="estado" value="Estado" />
        <select id="estado" name="estado" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <option value="1" @selected((string) old('estado', isset($producto) ? (int) $producto->estado : 1) === '1')>Activo</option>
            <option value="0" @selected((string) old('estado', isset($producto) ? (int) $producto->estado : 1) === '0')>Inactivo</option>
        </select>
        <x-input-error class="mt-2" :messages="$errors->get('estado')" />
    </div>

    <div class="flex items-center gap-4">
        <x-primary-button>
            {{ $textoBoton }}
        </x-primary-button>

        <a href="{{ route('productos.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
            Cancelar
        </a>
    </div>
</div>
