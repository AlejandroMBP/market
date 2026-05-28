<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Compra;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ReporteController extends Controller
{
    public function index(Request $request): View
    {
        return view('reportes.index', $this->reportData($request));
    }

    public function generalPdf(Request $request): Response
    {
        return $this->downloadPdf('reportes.pdf.general', $this->reportData($request), 'reporte-general.pdf');
    }

    public function ventasPdf(Request $request): Response
    {
        return $this->downloadPdf('reportes.pdf.ventas', $this->reportData($request), 'reporte-ventas.pdf');
    }

    public function comprasPdf(Request $request): Response
    {
        return $this->downloadPdf('reportes.pdf.compras', $this->reportData($request), 'reporte-compras.pdf');
    }

    public function inventarioPdf(Request $request): Response
    {
        $data = $this->reportData($request);
        $data['productos'] = Producto::with(['categoria', 'proveedor'])
            ->orderBy('nombre')
            ->get();

        return $this->downloadPdf('reportes.pdf.inventario', $data, 'reporte-inventario.pdf');
    }

    private function reportData(Request $request): array
    {
        $fechaInicio = $request->input('fecha_inicio');
        $fechaFin = $request->input('fecha_fin');
        $ventas = $this->ventasQuery($fechaInicio, $fechaFin)->get();
        $compras = $this->comprasQuery($fechaInicio, $fechaFin)->get();
        $productosBajoStock = Producto::with('categoria')
            ->whereColumn('stock', '<=', 'stock_minimo')
            ->orderBy('nombre')
            ->get();

        return [
            'ventas' => $ventas,
            'compras' => $compras,
            'productosBajoStock' => $productosBajoStock,
            'totalVentas' => $ventas->sum('total'),
            'totalCompras' => $compras->sum('total'),
            'fechaInicio' => $fechaInicio,
            'fechaFin' => $fechaFin,
            'generadoEn' => now(),
        ];
    }

    private function ventasQuery(?string $fechaInicio, ?string $fechaFin)
    {
        return Venta::with('user')
            ->when($fechaInicio, fn ($query) => $query->whereDate('fecha', '>=', $fechaInicio))
            ->when($fechaFin, fn ($query) => $query->whereDate('fecha', '<=', $fechaFin))
            ->latest('fecha');
    }

    private function comprasQuery(?string $fechaInicio, ?string $fechaFin)
    {
        return Compra::with(['proveedor', 'user'])
            ->when($fechaInicio, fn ($query) => $query->whereDate('fecha', '>=', $fechaInicio))
            ->when($fechaFin, fn ($query) => $query->whereDate('fecha', '<=', $fechaFin))
            ->latest('fecha');
    }

    private function downloadPdf(string $view, array $data, string $filename): Response
    {
        return Pdf::loadView($view, $data)
            ->setPaper('letter')
            ->download($filename);
    }
}
