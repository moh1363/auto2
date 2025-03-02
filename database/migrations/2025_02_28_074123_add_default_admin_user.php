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
        $defaultAdminUser = new \App\Models\User();
        $defaultAdminUser->firstname='admin';
        $defaultAdminUser->lastname='admin';
        $defaultAdminUser->personnel_id=1;
        $defaultAdminUser->post_title_id=1;
        $defaultAdminUser->email = 'admin@admin.com';
        $defaultAdminUser->password = bcrypt('admin');
        $defaultAdminUser->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
