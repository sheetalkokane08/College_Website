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
        // Add "faculty" to the enum on users.role
        // For MySQL, use change(). For PostgreSQL, the enum was created as varchar so just update column  constraints
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'student', 'faculty'])->default('student')->change();
            });
        }
        // PostgreSQL: enum was created as string, no special action needed; just allow the value
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::getConnection()->getDriverName() === 'mysql') {
            Schema::table('users', function (Blueprint $table) {
                $table->enum('role', ['admin', 'student'])->default('student')->change();
            });
        }
    }
};
