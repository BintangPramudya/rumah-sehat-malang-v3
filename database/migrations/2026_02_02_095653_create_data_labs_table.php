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
        Schema::create('data_labs', function (Blueprint $table) {
            $table->id();
            // OPTIONAL: kalau mau dikaitkan ke pasien
            $table->foreignId('patient_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // 🔥 inti: multi gambar
            $table->json('images');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_labs');
    }
};
