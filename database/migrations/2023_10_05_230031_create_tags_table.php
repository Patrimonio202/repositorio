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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('color');
           //obtiene 2 valores cero o 1 el uno es no destacada
           $table->enum('coleccion', [1,2])->default(1);
        
            //Con este guardamos la url del archivo
           $table->string('url');

           //Con este guardamos el nombre de la coleccion
           $table->string('titulocoleccion');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
