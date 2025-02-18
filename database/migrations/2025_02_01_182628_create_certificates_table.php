<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Relación con el usuario (doctor)
            $table->string('file_path'); // Ruta del archivo PDF
            $table->string('title'); // Título del certificado
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}
