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
        Schema::create('pruebas', function (Blueprint $table) {
            $table->id();
            $table->string('Tipo');
            $table->string('descripcion');
            $table->string('codigo');
            $table->text('pasos');
            $table->string('resultadoEsperado');
            $table->string('estado')->default('Asignada');
            $table->string('prioridad');
           $table->date('fechaEntrega')->nullable();
            // Relacion con requisitosFuncionales
            $table->unsignedBigInteger('requisito_id');
            $table->foreign('requisito_id')->references('id')->on('requisitos_funcionales');
            // Relacion con usuarios
            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pruebas');
    }
};
