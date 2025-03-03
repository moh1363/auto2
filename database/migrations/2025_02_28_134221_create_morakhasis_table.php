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
        Schema::create('morakhasis', function (Blueprint $table) {
            $table->id();
            $table->string('days_number');
            $table->integer('user_id');
            $table->string('start_date');
            $table->string('end_date');
            $table->string('type');
            $table->string('personnel_id');
            $table->text('comments')->nullable();
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->json('files')->nullable(); // ذخیره فایل‌ها به صورت JSON
            $table->foreign('user_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('morakhasis');
    }
};
