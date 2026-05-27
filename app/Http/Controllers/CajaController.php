<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class CajaController extends Controller
{
    public function index(): View
    {
        $cajas = Caja::with('user')->latest()->paginate(10);

        return view('cajas.index', compact('cajas'));
    }

    public function create(): View
    {
        return view('cajas.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $cajaAbierta = Caja::where('user_id', Auth::id())
            ->where('estado', 'abierta')
            ->exists();

        if ($cajaAbierta) {
            return redirect()
                ->route('cajas.index')
                ->with('success', 'Ya tienes una caja abierta. Debes cerrarla antes de abrir otra.');
        }

        $datos = $request->validate([
            'fecha_apertura' => ['required', 'date'],
            'monto_inicial' => ['required', 'numeric', 'min:0'],
            'observacion' => ['nullable', 'string'],
        ]);

        Caja::create([
            ...$datos,
            'user_id' => Auth::id(),
            'estado' => 'abierta',
        ]);

        return redirect()->route('cajas.index')->with('success', 'Caja abierta correctamente.');
    }

    public function show(Caja $caja): View
    {
        $caja->load(['user', 'ventas.metodoPago']);
        $totalVentas = $caja->ventas->sum('total');
        $montoEsperado = $caja->monto_inicial + $totalVentas;
        $diferencia = $caja->monto_final === null ? null : $caja->monto_final - $montoEsperado;
        $ventasPorMetodo = $caja->ventas
            ->groupBy('metodo_pago')
            ->map(fn ($ventas) => $ventas->sum('total'));

        return view('cajas.show', compact('caja', 'totalVentas', 'montoEsperado', 'diferencia', 'ventasPorMetodo'));
    }

    public function edit(Caja $caja): View
    {
        return view('cajas.edit', compact('caja'));
    }

    public function update(Request $request, Caja $caja): RedirectResponse
    {
        $datos = $request->validate([
            'fecha_cierre' => ['nullable', 'date'],
            'monto_final' => ['nullable', 'numeric', 'min:0'],
            'estado' => ['required', 'in:abierta,cerrada'],
            'observacion' => ['nullable', 'string'],
        ]);

        if ($datos['estado'] === 'cerrada' && blank($datos['fecha_cierre'])) {
            $datos['fecha_cierre'] = now();
        }

        $caja->update($datos);

        return redirect()->route('cajas.index')->with('success', 'Caja actualizada correctamente.');
    }

    public function destroy(Caja $caja): RedirectResponse
    {
        $caja->delete();

        return redirect()->route('cajas.index')->with('success', 'Caja eliminada correctamente.');
    }
}
