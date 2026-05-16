<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MovimientoStock extends Model
{
    use SoftDeletes;

    protected $table = 'movimientos_stock';

    protected $fillable = [
        'producto_id',
        'user_id',
        'tipo_movimiento',
        'referencia_id',
        'referencia_tipo',
        'stock_anterior',
        'cantidad',
        'stock_nuevo',
        'motivo',
        'fecha',
    ];

    protected $casts = [
        'referencia_id' => 'integer',
        'stock_anterior' => 'integer',
        'cantidad' => 'integer',
        'stock_nuevo' => 'integer',
        'fecha' => 'datetime',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
