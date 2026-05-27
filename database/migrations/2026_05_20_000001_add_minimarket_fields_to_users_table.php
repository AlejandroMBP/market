<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (! Schema::hasColumn('users', 'telefono')) {
                $table->string('telefono', 30)->nullable()->after('password');
            }

            if (! Schema::hasColumn('users', 'direccion')) {
                $table->text('direccion')->nullable()->after('telefono');
            }

            if (! Schema::hasColumn('users', 'foto')) {
                $table->string('foto')->nullable()->after('direccion');
            }

            if (! Schema::hasColumn('users', 'estado')) {
                $table->boolean('estado')->default(true)->after('foto');
            }

            if (! Schema::hasColumn('users', 'deleted_at')) {
                $table->softDeletes();
            }
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'deleted_at')) {
                $table->dropSoftDeletes();
            }

            foreach (['estado', 'foto', 'direccion', 'telefono'] as $column) {
                if (Schema::hasColumn('users', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
