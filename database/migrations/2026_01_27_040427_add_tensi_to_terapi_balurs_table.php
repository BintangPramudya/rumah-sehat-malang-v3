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
        Schema::table('terapi_balurs', function (Blueprint $table) {
            $table->string('tensi')->nullable()->after('therapy_datetime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('terapi_balurs', function (Blueprint $table) {
            $table->dropColumn('tensi');
        });
    }
};
