<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('callname', 100)->nullable()->after('name');
            $table->enum('gender', ['male', 'female'])->nullable()->after('callname');
            $table->string('employee_id', 50)->nullable()->unique()->after('gender');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['callname', 'gender', 'employee_id']);
        });
    }
};
