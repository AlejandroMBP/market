<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');//varchar
            //identificador  email CI DNI
            $table->string('email')->unique();//varchar y sera unico no permite nulos
            $table->timestamp('email_verified_at')->nullable(); //fecha va permitir nulos
            $table->string('password');
            // LO PUEDEN PERDER
            $table->String('telefono', 30) ->nullable();//limite de 30 caracteres
            $table->text('direccion')->nullable();
            $table->string('foto')->nullable();
            $table->boolean('estado')->default(1);// tiene un valor por defecto
            $table->rememberToken();
            $table->timestamps();// create_at y update_at
            $table->softDeletes();// delete_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
