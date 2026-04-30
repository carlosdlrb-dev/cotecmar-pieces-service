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
        Schema::create('piezas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('bloque_id')->constrained('bloques')->cascadeOnDelete();
            $table->string('codigo')->nullable();
            $table->decimal('peso_teorico', 12, 3);
            $table->decimal('peso_real', 12, 3);
            $table->decimal('diferencia_peso', 12, 3);
            $table->string('estado')->default('pendiente');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piezas');
    }
};
