<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productos = Producto::with(['categoria', 'proveedor'])
            ->latest()
            ->paginate(10);

        return view('productos.index', compact('productos'));
    }

    public function create(): View
    {
        return view('productos.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $datos = $this->validateProducto($request);

        Producto::create($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto): View
    {
        $producto->load(['categoria', 'proveedor']);

        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto): View
    {
        return view('productos.edit', [
            'producto' => $producto,
            ...$this->formOptions(),
        ]);
    }

    public function update(Request $request, Producto $producto): RedirectResponse
    {
        $datos = $this->validateProducto($request, $producto);

        $producto->update($datos);

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto): RedirectResponse
    {
        $producto->delete();

        return redirect()
            ->route('productos.index')
            ->with('success', 'Producto eliminado correctamente.');
    }

    private function formOptions(): array
    {
        return [
            'categorias' => Categoria::where('estado', true)->orderBy('nombre')->get(),
            'proveedores' => Proveedor::where('estado', true)->orderBy('nombre')->get(),
        ];
    }

    private function validateProducto(Request $request, ?Producto $producto = null): array
    {
        return $request->validate([
            'categoria_id' => ['required', 'exists:categorias,id'],
            'proveedor_id' => ['nullable', 'exists:proveedores,id'],
            'codigo_barra' => [
                'required',
                'string',
                'max:150',
                Rule::unique('productos', 'codigo_barra')->ignore($producto?->id),
            ],
            'nombre' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
            'precio_compra' => ['required', 'numeric', 'min:0'],
            'precio_venta' => ['required', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'stock_minimo' => ['required', 'integer', 'min:0'],
            'unidad_medida' => ['required', 'string', 'max:50'],
            'imagen' => ['nullable', 'string', 'max:255'],
            'estado' => ['required', 'boolean'],
        ]);
    }
}
