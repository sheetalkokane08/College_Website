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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->text('description')->nullable();
            $table->integer('credits')->default(3);
            $table->foreignId('department_id')->constrained()->cascadeOnDelete();
            $table->foreignId('faculty_id')->constrained('faculty')->cascadeOnDelete();
            $table->softDeletes();
            $table->timestamps();
            $table->index('code');
            $table->index(['department_id', 'faculty_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
