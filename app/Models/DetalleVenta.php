<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['venta_id', 'producto_id', 'cantidad', 'precio_venta', 'descuento', 'subtotal'])]
class DetalleVenta extends Model
{
    use SoftDeletes;

    protected $table = 'detalle_ventas';

    protected function casts(): array
    {
        return [
            'cantidad' => 'integer',
            'precio_venta' => 'decimal:2',
            'descuento' => 'decimal:2',
            'subtotal' => 'decimal:2',
        ];
    }

    public function venta(): BelongsTo
    {
        return $this->belongsTo(Venta::class);
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }
}
