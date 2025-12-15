<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('folders', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('icon')->default('/img/system/folder.png');
            $table->integer('sort')->default(0);
            $table->boolean('system')->default(false);
        });

        \App\Models\Folder::create([
            'id' => 1,
            'slug' => 'default',
            'name' => 'Общая',
            'system' => true,
        ]);
        \App\Models\Folder::create([
            'id' => 2,
            'slug' => 'basket',
            'name' => 'Корзина',
            'icon' => '/img/system/basket.png',
            'sort' => 10000,
            'system' => true,
        ]);
        \App\Models\Folder::create([
            'id' => 3,
            'slug' => 'video',
            'name' => 'Видео',
            'icon' => '/img/system/video.png',
            'sort' => 9999,
            'system' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folders');
    }
};
