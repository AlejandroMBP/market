<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cajas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('fecha_apertura');
            $table->dateTime('fecha_cierre')->nullable();
            $table->decimal('monto_inicial', 10, 2)->default(0);
            $table->decimal('monto_final', 10, 2)->nullable();
            $table->enum('estado', ['abierta', 'cerrada'])->default('abierta');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->foreignId('user_id')->constrained('users');
            $table->dateTime('fecha');
            $table->string('tipo_comprobante', 50)->nullable();
            $table->string('numero_comprobante', 100)->nullable();
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->enum('estado', ['pendiente', 'completada', 'anulada'])->default('completada');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cliente_id')->nullable()->constrained('clientes');
            $table->string('cliente_documento', 50)->nullable();
            $table->string('cliente_nombre')->nullable();
            $table->foreignId('caja_id')->nullable()->constrained('cajas');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('metodo_pago_id')->constrained('metodos_pago');
            $table->string('metodo_pago', 50)->nullable();
            $table->dateTime('fecha');
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('total', 10, 2)->default(0);
            $table->decimal('monto_pagado', 10, 2)->default(0);
            $table->decimal('cambio', 10, 2)->default(0);
            $table->enum('estado', ['completada', 'anulada'])->default('completada');
            $table->text('observacion')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('compra_id')->constrained('compras');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('cantidad');
            $table->decimal('precio_compra', 10, 2);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('venta_id')->constrained('ventas');
            $table->foreignId('producto_id')->constrained('productos');
            $table->integer('cantidad');
            $table->decimal('precio_venta', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0);
            $table->decimal('subtotal', 10, 2);
            $table->timestamps();
            $table->softDeletes();
        });

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
        Schema::dropIfExists('detalle_ventas');
        Schema::dropIfExists('detalle_compras');
        Schema::dropIfExists('ventas');
        Schema::dropIfExists('compras');
        Schema::dropIfExists('cajas');
    }
};
