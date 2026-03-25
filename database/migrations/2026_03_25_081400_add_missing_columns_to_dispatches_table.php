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
        Schema::table('dispatches', function (Blueprint $table) {
            // Rename phone to patient_phone if exists
            if (Schema::hasColumn('dispatches', 'phone') && !Schema::hasColumn('dispatches', 'patient_phone')) {
                $table->renameColumn('phone', 'patient_phone');
            } elseif (!Schema::hasColumn('dispatches', 'patient_phone')) {
                $table->string('patient_phone')->nullable()->after('patient_condition');
            }

            // Add mission timestamps if they don't exist
            if (!Schema::hasColumn('dispatches', 'pickup_at')) {
                $table->timestamp('pickup_at')->nullable()->after('assigned_at');
            }
            if (!Schema::hasColumn('dispatches', 'hospital_at')) {
                $table->timestamp('hospital_at')->nullable()->after('pickup_at');
            }
            if (!Schema::hasColumn('dispatches', 'completed_at')) {
                $table->timestamp('completed_at')->nullable()->after('hospital_at');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispatches', function (Blueprint $table) {
            $table->dropColumn(['pickup_at', 'hospital_at', 'completed_at']);
            
            if (Schema::hasColumn('dispatches', 'patient_phone')) {
                $table->renameColumn('patient_phone', 'phone');
            }
        });
    }
};
