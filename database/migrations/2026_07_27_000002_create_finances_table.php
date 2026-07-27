<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('finances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->integer('year')->default(2026);
            $table->string('period', 50)->default('YTD 2026');
            $table->decimal('target_rkap', 15, 2);
            $table->decimal('realization', 15, 2);
            $table->decimal('variance', 15, 2);
            $table->decimal('achievement', 5, 2);
            $table->string('performance_status', 50);
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('finances');
    }
};
