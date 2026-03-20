<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('dispatches', function (Blueprint $table) {
            $table->foreignId('event_request_id')->nullable()->after('driver_id')
                  ->constrained('event_requests')->nullOnDelete();
            
            // Track if this dispatch was created as a unit replacement
            $table->boolean('is_replacement')->default(false)->after('event_request_id');
            $table->foreignId('replaced_dispatch_id')->nullable()->after('is_replacement')
                  ->constrained('dispatches')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('dispatches', function (Blueprint $table) {
            $table->dropForeign(['event_request_id']);
            $table->dropForeign(['replaced_dispatch_id']);
            $table->dropColumn(['event_request_id', 'is_replacement', 'replaced_dispatch_id']);
        });
    }
};
