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
        Schema::table('ambulances', function (Blueprint $table) {
            if (!Schema::hasColumn('ambulances', 'last_location_update')) {
                $table->timestamp('last_location_update')->nullable()->after('longitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ambulances', function (Blueprint $table) {
            if (Schema::hasColumn('ambulances', 'last_location_update')) {
                $table->dropColumn('last_location_update');
            }
        });
    }
};
