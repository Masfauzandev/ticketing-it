<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Create ticket_cc pivot table
        Schema::create('ticket_cc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['ticket_id', 'user_id']);
        });

        // Remove priority column from tickets
        Schema::table('tickets', function (Blueprint $table) {
            $table->dropColumn('priority');
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            $table->enum('priority', ['low', 'medium', 'high', 'critical'])->default('medium')->after('status');
        });

        Schema::dropIfExists('ticket_cc');
    }
};
