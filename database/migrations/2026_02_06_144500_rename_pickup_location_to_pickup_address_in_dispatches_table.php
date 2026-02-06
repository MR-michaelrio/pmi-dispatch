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
            // Jika kolom lama ada → rename
            if (Schema::hasColumn('dispatches', 'pickup_location')) {
                $table->renameColumn('pickup_location', 'pickup_address');
            }

            // Jika kolom baru belum ada → buat
            if (!Schema::hasColumn('dispatches', 'pickup_address')) {
                $table->string('pickup_address')->nullable();
            }
            // $table->renameColumn('pickup_location', 'pickup_address');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispatches', function (Blueprint $table) {
           if (Schema::hasColumn('dispatches', 'pickup_address')) {
                $table->renameColumn('pickup_address', 'pickup_location');
            }

            // $table->renameColumn('pickup_address', 'pickup_location');
        });
    }
};
