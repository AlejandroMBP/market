<?php

namespace App\Http\Controllers;

use App\Models\MovimientoStock;
use Illuminate\View\View;

class MovimientoStockController extends Controller
{
    public function index(): View
    {
        $movimientos = MovimientoStock::with(['producto', 'user'])
            ->latest('fecha')
            ->paginate(15);

        return view('movimientos-stock.index', compact('movimientos'));
    }

    public function show(MovimientoStock $movimientoStock): View
    {
        $movimientoStock->load(['producto', 'user']);

        return view('movimientos-stock.show', compact('movimientoStock'));
    }
}
