<div class="header">
    <p class="brand">{{ config('app.name', 'Minimarket') }}</p>
    <p class="title">{{ $titulo }}</p>
    <div class="meta">
        Generado: {{ $generadoEn->format('d/m/Y H:i') }}
        @if ($fechaInicio || $fechaFin)
            | Periodo:
            {{ $fechaInicio ? \Carbon\Carbon::parse($fechaInicio)->format('d/m/Y') : 'inicio' }}
            -
            {{ $fechaFin ? \Carbon\Carbon::parse($fechaFin)->format('d/m/Y') : 'actual' }}
        @endif
    </div>
</div>
