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
    }

    public function create(): View
    {

    }

    public function store(Request $request): RedirectResponse
    {
           }

    public function show(Venta $venta): View
    {

    }

    public function destroy(Venta $venta): RedirectResponse
    {

    }

    private function validateVenta(Request $request): array
    {

    }

    private function filterEmptyProductRows(Request $request): void
    {

    }

    private function cajaAbierta(bool $lock = false): ?Caja
    {

    }
}
