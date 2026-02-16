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
        Schema::table('jadwal_hari_inis', function (Blueprint $table) {
            $table->foreignId('doctor_id')->nullable()->change();
            $table->foreignId('therapist_id')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal_hari_inis', function (Blueprint $table) {
            $table->foreignId('doctor_id')->nullable(false)->change();
            $table->foreignId('therapist_id')->nullable(false)->change();
        });
    }
};
