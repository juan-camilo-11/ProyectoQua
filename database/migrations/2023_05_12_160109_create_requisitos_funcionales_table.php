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
        Schema::create('requisitos_funcionales', function (Blueprint $table) {
            $table->id();
            $table->string('Nombre');
            $table->timestamps();
            // Relacion con criterios
            $table->unsignedBigInteger('criterio_id');
            $table->foreign('criterio_id')->references('id')->on('criterios');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('requisitos_funcionales');
    }
};
