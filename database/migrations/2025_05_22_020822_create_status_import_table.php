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
        Schema::create('status_import', function (Blueprint $table) {
            $table->id();
            $table->string('reference')->unique();
            $table->enum('current_step', [
                'processing',
                'imported',
                'completed',
                'failed'
            ])->default('processing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('status_import');
    }
};
