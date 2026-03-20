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
        Schema::table('patient_requests', function (Blueprint $table) {
            $table->time('pickup_time')->nullable()->after('request_date');
        });

        Schema::table('dispatches', function (Blueprint $table) {
            $table->date('request_date')->nullable()->after('patient_name');
            $table->time('pickup_time')->nullable()->after('request_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('patient_requests', function (Blueprint $table) {
            $table->dropColumn('pickup_time');
        });

        Schema::table('dispatches', function (Blueprint $table) {
            $table->dropColumn(['request_date', 'pickup_time']);
        });
    }
};
