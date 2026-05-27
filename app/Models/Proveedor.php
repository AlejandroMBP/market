<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nombre', 'nit', 'telefono', 'direccion', 'correo', 'estado'])]
class Proveedor extends Model
{
    use SoftDeletes;

    protected $table = 'proveedores';

    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function productos(): HasMany
    {
        return $this->hasMany(Producto::class);
    }

    public function compras(): HasMany
    {
        return $this->hasMany(Compra::class);
    }
}
