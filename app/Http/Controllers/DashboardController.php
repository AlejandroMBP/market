<?php

namespace App\Http\Controllers;

use App\Models\Caja;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();
        $data = [];

        if ($user->can('dashboard.admin')) {
            $ventasHoy = Venta::whereDate('fecha', today())->sum('total');
            $comprasHoy = Compra::whereDate('fecha', today())->sum('total');

            $data = [
                'ventasHoy' => $ventasHoy,
                'comprasHoy' => $comprasHoy,
                'gananciaEstimadaHoy' => $ventasHoy - $comprasHoy,
                'productosActivos' => Producto::where('estado', true)->count(),
                'productosBajoStock' => Producto::whereColumn('stock', '<=', 'stock_minimo')->count(),
                'usuariosActivos' => User::where('estado', true)->count(),
                'cajasAbiertas' => Caja::where('estado', 'abierta')->count(),
                'ultimasVentas' => Venta::with('user')->latest('fecha')->limit(5)->get(),
                'productosCriticos' => Producto::with('categoria')
                    ->whereColumn('stock', '<=', 'stock_minimo')
                    ->orderBy('stock')
                    ->limit(5)
                    ->get(),
            ];
        }

        return view('dashboard', $data);
    }
}
