<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('action'); // LOGIN, LOGOUT, UPDATE_PROFILE, CHANGE_PASSWORD, CREATE_UNIT, UPDATE_UNIT, DELETE_UNIT, CREATE_REVENUE, DELETE_REVENUE
            $table->text('description');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->timestamps();
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
