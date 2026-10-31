<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

// create_suscriptores_table - v1.0 (30/10/2026)
// Suscriptores del boletin ("Suscribete a nuestro boletin" del pie de pagina).
// En el servidor el usuario de la aplicacion no puede crear tablas: alli se crea con
// database/sql/2026_10_30_suscriptores.sql y esta migracion solo se registra (no hace nada si la tabla existe).
return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('suscriptores')) {
            return;
        }
        Schema::create('suscriptores', function (Blueprint $table) {
            $table->id();
            $table->string('email', 190)->unique();
            $table->char('token', 64)->unique();      // enlace de confirmacion y de baja
            $table->timestamp('aceptado_en')->nullable();   // cuando acepto la politica de privacidad
            $table->timestamp('confirmado_en')->nullable(); // cuando confirmo desde su correo
            $table->timestamp('baja_en')->nullable();       // cuando se dio de baja
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suscriptores');
    }
};
