<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("ALTER TABLE patient_requests MODIFY COLUMN patient_condition ENUM('emergency', 'kontrol', 'pasien_pulang')");
        DB::statement("ALTER TABLE dispatches MODIFY COLUMN patient_condition ENUM('emergency', 'kontrol', 'jenazah', 'pasien_pulang')");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE patient_requests MODIFY COLUMN patient_condition ENUM('emergency', 'kontrol')");
        DB::statement("ALTER TABLE dispatches MODIFY COLUMN patient_condition ENUM('emergency', 'kontrol', 'jenazah')");
    }
};
