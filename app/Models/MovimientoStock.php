<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable([
    'producto_id',
    'user_id',
    'tipo_movimiento',
    'referencia_id',
    'referencia_tipo',
    'stock_anterior',
    'cantidad',
    'stock_nuevo',
    'motivo',
    'fecha'
    ])]
class MovimientoStock extends Model
{
    use SoftDeletes;

    protected $table = 'movimientos_stock';

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'stock_anterior' => 'integer',
            'cantidad' => 'integer',
            'stock_nuevo' => 'integer',
        ];
    }

    public function producto(): BelongsTo
    {
        return $this->belongsTo(Producto::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
