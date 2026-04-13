<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cartorios', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('cnpj');
            $table->string('nome_tabeliao');
            $table->boolean('ativo')->default(true);
            $table->foreignId('municipio_id')->constrained('municipios');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cartorios');
    }
};