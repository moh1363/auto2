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
        Schema::create('morakhasi_approvals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('morakhasi_id')->constrained()->onDelete('cascade');
            $table->foreignId('approver_id')->constrained('users')->onDelete('cascade');
            $table->text('comments')->nullable();
            $table->string('is_checked')->nullable();
            $table->text('view_time')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->date('approved_time')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morakhasi_approvals');
    }
};
