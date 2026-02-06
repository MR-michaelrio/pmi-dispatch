<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('dispatches', function (Blueprint $table) {
    $table->id();

    $table->string('patient_name');
    $table->enum('patient_condition', ['emergency', 'kontrol', 'jenazah']);

    $table->string('phone')->nullable();
    $table->text('pickup_location');
    $table->text('destination')->nullable();

    $table->foreignId('ambulance_id')->nullable()->constrained()->nullOnDelete();
    $table->foreignId('driver_id')->nullable()->constrained()->nullOnDelete();

    $table->enum('status', ['pending', 'on_route', 'completed'])->default('pending');

    $table->timestamps();
});

    }

    public function down(): void
    {
        Schema::dropIfExists('dispatches');
    }
};
