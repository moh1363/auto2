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
        $defaultAdminUser->id=1;
        $defaultAdminUser->firstname='مدیرگروه';
        $defaultAdminUser->lastname='admin';
        $defaultAdminUser->personnel_id=1;
        $defaultAdminUser->post_title_id=1;
        $defaultAdminUser->email = 'admin@admin.com';
        $defaultAdminUser->password = bcrypt('123456');
        $defaultAdminUser->save();


        $defaultAdminUser = new \App\Models\User();
        $defaultAdminUser->id=2;

        $defaultAdminUser->firstname='مدیراداری';
        $defaultAdminUser->lastname='admin';
        $defaultAdminUser->personnel_id=2;
        $defaultAdminUser->post_title_id=2;
        $defaultAdminUser->email = 'admin1@admin.com';
        $defaultAdminUser->password = bcrypt('123456');
        $defaultAdminUser->save();


        $defaultAdminUser = new \App\Models\User();
        $defaultAdminUser->id=3;

        $defaultAdminUser->firstname='مدیر ارشد علمی';
        $defaultAdminUser->lastname='admin';
        $defaultAdminUser->personnel_id=3;
        $defaultAdminUser->post_title_id=3;
        $defaultAdminUser->email = 'admin2@admin.com';
        $defaultAdminUser->password = bcrypt('123456');
        $defaultAdminUser->save();


        $defaultAdminUser = new \App\Models\User();
        $defaultAdminUser->id=4;

        $defaultAdminUser->firstname='مدیر آموزش';
        $defaultAdminUser->lastname='admin';
        $defaultAdminUser->personnel_id=4;
        $defaultAdminUser->post_title_id=4;
        $defaultAdminUser->email = 'admin3@admin.com';
        $defaultAdminUser->password = bcrypt('123456');
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
