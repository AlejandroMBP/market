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
    }

    public function generalPdf(Request $request): Response
    {
    }

    public function ventasPdf(Request $request): Response
    {
    }

    public function comprasPdf(Request $request): Response
    {
    }

    public function inventarioPdf(Request $request): Response
    {

    }

    private function reportData(Request $request): array
    {

    }

    private function ventasQuery(?string $fechaInicio, ?string $fechaFin)
    {

    }

    private function comprasQuery(?string $fechaInicio, ?string $fechaFin)
    {

    }

    private function downloadPdf(string $view, array $data, string $filename): Response
    {

    }
}
