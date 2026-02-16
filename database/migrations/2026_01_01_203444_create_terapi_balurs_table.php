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
        Schema::create('terapi_balurs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('patients')->nullable();
            $table->dateTime('therapy_datetime')->nullable();
            $table->text('pre_complaint')->nullable();
            $table->text('post_complaint')->nullable();
            $table->string('rokok')->nullable();
            $table->text('therapist_notes')->nullable();
            $table->string('image_tembaga')->nullable();
            $table->string('image_patient')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('terapi_balurs');
    }
};
