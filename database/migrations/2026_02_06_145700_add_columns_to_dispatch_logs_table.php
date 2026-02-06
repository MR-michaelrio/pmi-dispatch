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
        Schema::table('dispatch_logs', function (Blueprint $table) {
            $table->foreignId('dispatch_id')->constrained()->cascadeOnDelete()->after('id');
            $table->string('status')->after('dispatch_id'); // Assuming status matches dispatch status or is a string
            $table->text('note')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('dispatch_logs', function (Blueprint $table) {
            $table->dropForeign(['dispatch_id']);
            $table->dropColumn(['dispatch_id', 'status', 'note']);
        });
    }
};
