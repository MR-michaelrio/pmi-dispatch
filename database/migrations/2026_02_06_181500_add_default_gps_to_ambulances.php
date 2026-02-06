<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add default GPS coordinates to existing ambulances (Jakarta center)
        DB::table('ambulances')->update([
            'latitude' => -6.200000,
            'longitude' => 106.816666,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No need to reverse
    }
};
