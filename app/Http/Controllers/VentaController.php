<?php

namespace App\Http\Controllers;

use App\Models\MetodoPago;
use App\Models\MovimientoStock;
use App\Models\Producto;
use App\Models\Venta;
use App\Models\Caja;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;

class VentaController extends Controller
{
    public function index(): View
    {
        $ventas = Venta::with(['user','metodoPago'])->latest('fecha')->paginate(10);
        return  view('ventas.index',compact('ventas'));
    }

    public function create(): View
    {
        $cajaAbierta = $this->cajaAbierta();

        return view('ventas.create',[
            'productos' => Producto::where('estado',true)->where('stock','>',0)->orderBy('nombre')->get(),
            'metodosPago' => MetodoPago::where('estado',true)->orderBy('nombre')->get(),
            'cajaAbierta' => $cajaAbierta,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {

        $this->filterEmptyProductRows($request);
        $datos = $this->validateVenta($request);

        DB::transaction(function () use ($datos): void {
            $caja = $this->cajaAbierta(lock: true);
            if(!$caja){
                throw ValidationException::withMessages([
                    'caja' => 'Debes abrir una caja antes de registrar ventas.',
                ]);
            }

            $metodoPago = MetodoPago::findOrFail($datos['metodo_pago_id']);

            $venta = Venta::create([
                'cliente_id' => null,
                'cliente_docuemnto' => $datos['cliente_documento'],
                'cliente_nombre' => $datos['cliente_nombre'],
                'caja_id' => $caja->id,
                'user_id' => Auth::id(),
                'metodo_pago_id' => $metodoPago->id,
                'metodo_pago' => $metodoPago->nombre,
                'fecha' => $datos['fecha'],
                'descuento' => $datos['descuento'],
                'monto_pagado' => $datos['monto_pagado'],
                'estado' => 'completada',
                'observacion' => $datos['observacion'],
                'subtotal' => 0,
                'total' => 0,
                'cambio' => 0,
            ]);
            $subtotalVenta = 0;

            foreach($datos['productos'] as $linea){
                $producto =Producto::lockForUpdate()->findOrFail($linea['producto_id']);

                if($producto->stock < $linea['cantidad']){
                    throw ValidateException::withMessages([
                        'productos'=>"Stock insuficiente para {$producto->nombre}."
                    ]);
                }

                $subtotal = ($linea['cantidad']* $linea['precio_venta']) - $linea['descuento'];
                $stockAnterior = $producto->stock;
                $stockNuevo = $stockAnterior - $linea['cantidad'];

                $venta->detalles()->create([
                    'producto_id' => $producto->id,
                    'cantidad' => $linea['cantidad'],
                    'precio_venta' => $linea['precio_venta'],
                    'descuento' => $linea['descuento'],
                    'subtotal' => $subtotal,
                ]);
                $producto->update(['stock'=>$stockNuevo]);
                MovimientoStock::create([
                    'producto_id' => $producto->id,
                    'user_id'  => Auth::id(),
                    'tipo_movimiento' => 'salida',
                    'referencia_id' => $venta->id,
                    'referencia_tipo'=> 'venta',
                    'stock_anterior'=> $stockAnterior,
                    'cantidad'=>$linea['cantidad'],
                    'stock_nuevo'=>$stockNuevo,
                    'motivo'=>'ventaregistrada' ,
                    'fecha' =>$datos['fecha'],
                ]);
                $subtotalVenta +=$subtotal;
            }
            $total = max($subtotalVenta - $datos['descuento'],0);

            $venta->update([
                'subtotal'=>$subtotalVenta,
                'total' => $total,
                'cambio' => max($datos['monto_pagado']-$total,0),
            ]);

        });
        return redirect()->route('ventas.index')->with('success','Venta registrada correctamente.');
    }


    public function show(Venta $venta): View
    {
        $venta->load(['user', 'caja', 'metodoPago', 'detalles.producto']);

        return view('ventas.show', compact('venta'));
    }

    public function destroy(Venta $venta): RedirectResponse
    {
        $venta->update(['estado' => 'anulada']);
        $venta->delete();

        return redirect()->route('ventas.index')->with('success', 'Venta anulada correctamente.');
    }


    private function validateVenta(Request $request): array
    {
        return $request->validate([
            'fecha' => ['required', 'date'],
            'cliente_documento' => ['nullable', 'string', 'max:50'],
            'cliente_nombre' => ['nullable', 'string', 'max:255'],
            'metodo_pago_id' => ['required', 'exists:metodos_pago,id'],
            'descuento' => ['required', 'numeric', 'min:0'],
            'monto_pagado' => ['required', 'numeric', 'min:0'],
            'observacion' => ['nullable', 'string'],
            'productos' => ['required', 'array', 'min:1'],
            'productos.*.producto_id' => ['required', 'exists:productos,id'],
            'productos.*.cantidad' => ['required', 'integer', 'min:1'],
            'productos.*.precio_venta' => ['required', 'numeric', 'min:0'],
            'productos.*.descuento' => ['required', 'numeric', 'min:0'],
        ]);
    }

    private function filterEmptyProductRows(Request $request): void
    {
        $productos = collect($request->input('productos', []))
            ->filter(fn (array $producto): bool => filled($producto['producto_id'] ?? null))
            ->map(function (array $producto): array {
                $producto['descuento'] = $producto['descuento'] ?? 0;

                return $producto;
            })
            ->values()
            ->all();

        $request->merge(['productos' => $productos]);
    }

    private function cajaAbierta(bool $lock = false): ?Caja
    {
        $query = Caja::where('user_id', Auth::id())->where('estado','abierta')->latest('fecha_apertura');
        if($lock){
            $query->lockForUpdate();
        }
        return $query->first();
    }
}
