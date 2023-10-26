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
        Schema::create('posts', function (Blueprint $table) {
            //atributos
            $table->id();
            $table->string('name');
            $table->string('slug');           
            $table->longText('body')->nullable();            
            // $table->dateTime('anocreacion')->default('2023-10-12'); yyyy-mm-dd
            $table->date('anocreacion')->default('1900-01-01');

            //$table->string('tema');
            $table->string('autor');
            //solo obtiene 2 valores cero o 1  el uno es no destacada
            $table->enum('destacada', [1,2])->default(1); 

            //obtiene 2 valores cero o 1 el uno es no destacada
            $table->enum('status', [1,2])->default(1);
            //relaciones            
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('tema_id');
            $table->unsignedBigInteger('user_id');
            
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade'); 
            $table->foreign('tema_id')->references('id')->on('temas')->onDelete('cascade');          
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
