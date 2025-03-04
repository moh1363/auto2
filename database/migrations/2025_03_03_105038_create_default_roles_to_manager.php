<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Role;
use App\Models\Permission;
use Spatie\Permission\Models\Role as SpatieRole;
use Spatie\Permission\Models\Permission as SpatiePermission;
use App\Models\User;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('default_roles_to_manager', function (Blueprint $table) {
            $role=SpatieRole::where('name','مدیرگروه')->first();
            $permission=SpatiePermission::all();
            $role->syncPermissions($permission);

            $user=User::find(1);
            $user->assignRole($role->id);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('default_roles_to_manager');
    }
};
