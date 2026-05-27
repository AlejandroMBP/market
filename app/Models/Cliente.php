<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

#[Fillable(['nombre', 'nit_ci', 'telefono', 'direccion', 'correo', 'estado'])]
class Cliente extends Model
{
    use SoftDeletes;

    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function ventas(): HasMany
    {
        return $this->hasMany(Venta::class);
    }
}
