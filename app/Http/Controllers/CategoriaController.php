<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoriaController extends Controller
{
    public function index(): View
    {
        $categorias = Categoria::latest()->paginate(10);

        return view('categorias.index', compact('categorias'));
    }

    public function create(): View
    {
        return view('categorias.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Categoria::create($this->validateCategoria($request));

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria creada correctamente.');
    }

    public function show(Categoria $categoria): View
    {
        return view('categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria): View
    {
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria): RedirectResponse
    {
        $categoria->update($this->validateCategoria($request, $categoria));

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria actualizada correctamente.');
    }

    public function destroy(Categoria $categoria): RedirectResponse
    {
        $categoria->delete();

        return redirect()
            ->route('categorias.index')
            ->with('success', 'Categoria eliminada correctamente.');
    }

    // al ser una tabla
    private function validateCategoria(Request $request, ?Categoria $categoria = null): array
    {
        return $request->validate([
            'nombre' => [
                'required',
                'string',
                'max:150',
                Rule::unique('categorias', 'nombre')->ignore($categoria?->id),
            ],
            'descripcion' => ['nullable', 'string'],
            'estado' => ['required', 'boolean'],
        ]);
    }
}
