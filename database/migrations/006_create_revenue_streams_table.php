<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('revenue_streams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->string('name');
            $table->string('category', 100);
            $table->decimal('target_amount', 15, 2);
            $table->decimal('realization_amount', 15, 2);
            $table->decimal('contribution_percentage', 5, 2)->default(0);
            $table->decimal('growth_rate', 5, 2)->default(0);
            $table->string('period', 50)->default('YTD 2026');
            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('revenue_streams');
    }
};
