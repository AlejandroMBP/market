<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['proveedor_id', 'user_id', 'fecha', 'tipo_comprobante', 'numero_comprobante', 'subtotal', 'descuento', 'total', 'estado', 'observacion'])]
class Compra extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
            'subtotal' => 'decimal:2',
            'descuento' => 'decimal:2',
            'total' => 'decimal:2',
        ];
    }

    public function proveedor(): BelongsTo
    {
        return $this->belongsTo(Proveedor::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function detalles(): HasMany
    {
        return $this->hasMany(DetalleCompra::class);
    }
}
