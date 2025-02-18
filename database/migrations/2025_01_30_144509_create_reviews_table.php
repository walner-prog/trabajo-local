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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->foreignId('client_id')->constrained('users')->onDelete('cascade'); // Cliente que deja la reseña
            $table->integer('rating')->check('rating BETWEEN 1 AND 5');
            $table->text('comment')->nullable();
            $table->timestamps();
            $table->softDeletes(); // Eliminación lógica
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
