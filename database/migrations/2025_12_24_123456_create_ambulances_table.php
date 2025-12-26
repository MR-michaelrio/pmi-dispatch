<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('ambulances', function (Blueprint $table) {
            $table->id();

            // Identitas Ambulans
            $table->string('code')->unique();        // GMCI-A01
            $table->string('plate_number');          // B 1234 ABC
            $table->string('type');                  // ICU / BASIC / NICU

            // Status Operasional
            $table->enum('status', [
                'ready',
                'on_duty',
                'maintenance'
            ])->default('ready');

            // Lokasi terakhir (opsional, untuk pengembangan GPS)
            $table->string('last_location')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('ambulances');
    }
};
