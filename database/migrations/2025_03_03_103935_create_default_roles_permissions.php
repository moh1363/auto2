<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Spatie\Permission\Models\Permission as SpatiePermission;
use Spatie\Permission\Models\Role as SpatieRole;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_roles_permissions', function (Blueprint $table) {
            SpatieRole::create([
                'name' => 'مدیرگروه',
                'id'=>1
            ]);
            SpatieRole::create([
                'name' => 'مدیراداری',
                'id'=>2
            ]);
            SpatieRole::create([
                'name' => 'مدیرارشد علمی',
                'id'=>3
            ]);
            SpatieRole::create([
                'name' => 'مدیرآموزش',
                'id'=>4
            ]);
            SpatiePermission::create([
                'name' => 'ایجاد کاربر',
                'id'=>1
            ]);
            SpatiePermission::create([
                'name' => 'مشاهده کاربر',
                'id'=>2
            ]);
            SpatiePermission::create([
                'name' => 'ویرایش کاربر',
                'id'=>3
            ]);
            SpatiePermission::create([
                'name' => 'حذف کاربر',
                'id'=>4
            ]);
            SpatiePermission::create([
                'name' => 'مشاهده لیست مرخصی کارکنان',
                'id'=>5
            ]);
            SpatiePermission::create([
                'name' => 'تایید مرخصی',
                'id'=>1
            ]);





        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_roles_permissions');
    }
};
