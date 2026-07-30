<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    // Run the migrations.
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('role', 30)->default('staff')->after('email'); // manager, staff, supervisor
        });

        Schema::table('revenue_streams', function (Blueprint $table) {
            $table->string('proof_file')->nullable()->after('period');
            $table->string('approval_status', 30)->default('pending')->after('proof_file'); // pending, approved, rejected
            $table->text('rejection_reason')->nullable()->after('approval_status');
            $table->foreignId('approved_by')->nullable()->after('rejection_reason')->constrained('users')->onDelete('set null');
        });
    }

    // Reverse the migrations.
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('role');
        });

        Schema::table('revenue_streams', function (Blueprint $table) {
            $table->dropForeign(['approved_by']);
            $table->dropColumn(['proof_file', 'approval_status', 'rejection_reason', 'approved_by']);
        });
    }
};
