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
        Schema::create('awards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('proveedor_id')->constrained('proveedores');
            $table->string('award_name'); // Nombre del premio
            $table->string('awarding_institution'); // Institución que otorga el premio
            $table->year('year'); // Año de otorgamiento
            $table->text('description')->nullable(); // Descripción opcional
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('awards');
    }
};
