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
        Schema::create('user_skill', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('skill_id')->constrained()->onDelete('cascade');
            $table->string('level'); // e.g. Junior, Mid, Senior
            $table->text('description')->nullable(); // e.g. Junior, Mid, Senior
            $table->string('approved_time')->nullable();
            $table->unsignedBigInteger('created_by');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('files')->nullable(); // ذخیره فایل‌ها به صورت JSON
            $table->unsignedBigInteger('approved_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('approved_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skill');
    }
};
