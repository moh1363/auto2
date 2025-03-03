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
        $defaultPostTitle = new \App\Models\PostTitle();
        $defaultPostTitle->id=1;
        $defaultPostTitle->title='مدیرگروه';
        $defaultPostTitle->save();
        $defaultPostTitle = new \App\Models\PostTitle();
        $defaultPostTitle->id=2;
        $defaultPostTitle->title='مدیر اداری';
        $defaultPostTitle->parent_id =1;
        $defaultPostTitle->save();
        $defaultPostTitle = new \App\Models\PostTitle();
        $defaultPostTitle->id=3;
        $defaultPostTitle->title='مدیر ارشد علمی';
        $defaultPostTitle->parent_id =1;
        $defaultPostTitle->save();
        $defaultPostTitle = new \App\Models\PostTitle();
        $defaultPostTitle->id=4;
        $defaultPostTitle->title='مدیرآموزش';
        $defaultPostTitle->parent_id =1;

        $defaultPostTitle->save();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
