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
        Schema::create('status_importacao_anuncios', function (Blueprint $table) {
            $table->id();
            $table->string('cod_anuncio');
            $table->string('marketplace_name');
            $table->string('status')->default('importacao_pendente')->comment('importacao_pendente, solicitando_informacoes, enviando_para_hub, concluido, falhou');
            $table->json('payload')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_importacao_anuncios');
    }
};
