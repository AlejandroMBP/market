<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movimientos_stock', function (Blueprint $table) {
            $table->id();
            $table->foreignId('producto_id')->constrained('productos');
            $table->foreignId('user_id')->constrained('users');
            $table->enum('tipo_movimiento', ['entrada', 'salida', 'ajuste', 'devolucion']);
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->enum('referencia_tipo', ['compra', 'venta', 'ajuste_manual'])->nullable();
            $table->integer('stock_anterior');
            $table->integer('cantidad');
            $table->integer('stock_nuevo');
            $table->text('motivo')->nullable();
            $table->dateTime('fecha');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movimientos_stock');
    }
};
