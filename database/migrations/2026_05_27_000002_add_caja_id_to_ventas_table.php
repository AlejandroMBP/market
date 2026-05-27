<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (! Schema::hasColumn('ventas', 'caja_id')) {
                $table->foreignId('caja_id')->nullable()->after('cliente_nombre')->constrained('cajas');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (Schema::hasColumn('ventas', 'caja_id')) {
                $table->dropConstrainedForeignId('caja_id');
            }
        });
    }
};
