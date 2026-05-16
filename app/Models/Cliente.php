<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Model
{
    use SoftDeletes;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'nit_ci',
        'telefono',
        'direccion',
        'correo',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
}
