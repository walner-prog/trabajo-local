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
        Schema::create('proveedores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->onDelete('cascade');
            $table->string('specialty');
            $table->string('city');
            $table->integer('experience_years');
            $table->text('bio')->nullable();
            $table->string('location')->nullable();
            $table->string('phone')->nullable();
            $table->string('certifications')->nullable();  // Certificaciones
            $table->string('education')->nullable();  // Educación
            $table->string('languages')->nullable();  // Idiomas
            $table->decimal('average_rating', 2, 1)->nullable();  // Promedio de calificación
            $table->integer('reviews_count')->nullable();  // Número de reseñas
            $table->boolean('verified')->default(false);
            $table->json('availability')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proveedors');
    }
};
