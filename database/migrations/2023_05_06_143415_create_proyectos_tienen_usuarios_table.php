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
        Schema::create('proyectos_tienen_usuarios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('usuario_id');
            $table->unsignedBigInteger('proyecto_id');
            $table->String('cargo_id');

            //Relacion 
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->foreign('proyecto_id')->references('id')->on('proyectos');
            

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proyectos_tienen_usuarios');
    }
};
