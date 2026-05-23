<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProveedorController extends Controller
{
    public function index(): View
    {
        $proveedores = Proveedor::latest()->paginate(10);

        return view('proveedores.index', compact('proveedores'));
    }

    public function create(): View
    {
        return view('proveedores.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Proveedor::create($this->validateProveedor($request));

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor creado correctamente.');
    }

    public function show(Proveedor $proveedor): View
    {
        return view('proveedores.show', compact('proveedor'));
    }

    public function edit(Proveedor $proveedor): View
    {
        return view('proveedores.edit', compact('proveedor'));
    }

    public function update(Request $request, Proveedor $proveedor): RedirectResponse
    {
        $proveedor->update($this->validateProveedor($request));

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor actualizado correctamente.');
    }

    public function destroy(Proveedor $proveedor): RedirectResponse
    {
        $proveedor->delete();

        return redirect()
            ->route('proveedores.index')
            ->with('success', 'Proveedor eliminado correctamente.');
    }

    private function validateProveedor(Request $request): array
    {
        return $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'nit' => ['nullable', 'string', 'max:50'],
            'telefono' => ['nullable', 'string', 'max:30'],
            'direccion' => ['nullable', 'string'],
            'correo' => ['nullable', 'email', 'max:150'],
            'estado' => ['required', 'boolean'],
        ]);
    }
}
