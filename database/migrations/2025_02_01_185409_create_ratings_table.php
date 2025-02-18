<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingsTable extends Migration
{
    public function up()
    {
        Schema::create('ratings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Relación con usuarios
            $table->foreignId('proveedor_id')->unique()->constrained('proveedores')->onDelete('cascade');
          //  $table->foreignId('post_id')->nullable()->constrained('posts')->onDelete('cascade');
            $table->integer('rating'); // Calificación (1-5)
            $table->string('review')->nullable(); // Reseña opcional
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('ratings');
    }
}
