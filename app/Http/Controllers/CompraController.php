<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\MovimientoStock;
use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CompraController extends Controller
{
    public function index(): View
    {
        $compras = Compra::with(['proveedor', 'user'])->latest('fecha')->paginate(10);

        return view('compras.index', compact('compras'));
    }

    public function create(): View
    {
        return view('compras.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $this->filterEmptyProductRows($request);

        $datos = $this->validateCompra($request);

        DB::transaction(function () use ($datos): void {
            $compra = Compra::create([
                'proveedor_id' => $datos['proveedor_id'],
                'user_id' => Auth::id(),
                'fecha' => $datos['fecha'],
                'tipo_comprobante' => $datos['tipo_comprobante'],
                'numero_comprobante' => $datos['numero_comprobante'],
                'descuento' => $datos['descuento'],
                'estado' => 'completada',
                'observacion' => $datos['observacion'],
                'subtotal' => 0,
                'total' => 0,
            ]);

            $subtotalCompra = 0;

            foreach ($datos['productos'] as $linea) {
                $producto = Producto::lockForUpdate()->findOrFail($linea['producto_id']);
                $subtotal = $linea['cantidad'] * $linea['precio_compra'];
                $stockAnterior = $producto->stock;
                $stockNuevo = $stockAnterior + $linea['cantidad'];

                $compra->detalles()->create([
                    'producto_id' => $producto->id,
                    'cantidad' => $linea['cantidad'],
                    'precio_compra' => $linea['precio_compra'],
                    'subtotal' => $subtotal,
                ]);

                $producto->update([
                    'precio_compra' => $linea['precio_compra'],
                    'stock' => $stockNuevo,
                ]);

                MovimientoStock::create([
                    'producto_id' => $producto->id,
                    'user_id' => Auth::id(),
                    'tipo_movimiento' => 'entrada',
                    'referencia_id' => $compra->id,
                    'referencia_tipo' => 'compra',
                    'stock_anterior' => $stockAnterior,
                    'cantidad' => $linea['cantidad'],
                    'stock_nuevo' => $stockNuevo,
                    'motivo' => 'Compra registrada',
                    'fecha' => $datos['fecha'],
                ]);

                $subtotalCompra += $subtotal;
            }

            $compra->update([
                'subtotal' => $subtotalCompra,
                'total' => max($subtotalCompra - $datos['descuento'], 0),
            ]);
        });

        return redirect()->route('compras.index')->with('success', 'Compra registrada correctamente.');
    }

    public function show(Compra $compra): View
    {
        $compra->load(['proveedor', 'user', 'detalles.producto']);

        return view('compras.show', compact('compra'));
    }

    public function destroy(Compra $compra): RedirectResponse
    {
        $compra->update(['estado' => 'anulada']);
        $compra->delete();

        return redirect()->route('compras.index')->with('success', 'Compra anulada correctamente.');
    }

    private function formOptions(): array
    {
        return [
            'proveedores' => Proveedor::where('estado', true)->orderBy('nombre')->get(),
            'productos' => Producto::where('estado', true)->orderBy('nombre')->get(),
        ];
    }

    private function validateCompra(Request $request): array
    {
        return $request->validate([
            'proveedor_id' => ['required', 'exists:proveedores,id'],
            'fecha' => ['required', 'date'],
            'tipo_comprobante' => ['nullable', 'string', 'max:50'],
            'numero_comprobante' => ['nullable', 'string', 'max:100'],
            'descuento' => ['required', 'numeric', 'min:0'],
            'observacion' => ['nullable', 'string'],
            'productos' => ['required', 'array', 'min:1'],
            'productos.*.producto_id' => ['required', 'exists:productos,id'],
            'productos.*.cantidad' => ['required', 'integer', 'min:1'],
            'productos.*.precio_compra' => ['required', 'numeric', 'min:0'],
        ]);
    }

    private function filterEmptyProductRows(Request $request): void
    {
        $productos = collect($request->input('productos', []))
            ->filter(fn (array $producto): bool => filled($producto['producto_id'] ?? null))
            ->values()
            ->all();

        $request->merge(['productos' => $productos]);
    }
}
