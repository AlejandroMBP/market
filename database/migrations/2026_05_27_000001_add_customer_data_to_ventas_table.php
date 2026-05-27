<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            if (! Schema::hasColumn('ventas', 'cliente_documento')) {
                $table->string('cliente_documento', 50)->nullable()->after('cliente_id');
            }

            if (! Schema::hasColumn('ventas', 'cliente_nombre')) {
                $table->string('cliente_nombre')->nullable()->after('cliente_documento');
            }
        });
    }

    public function down(): void
    {
        Schema::table('ventas', function (Blueprint $table) {
            foreach (['cliente_nombre', 'cliente_documento'] as $column) {
                if (Schema::hasColumn('ventas', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
