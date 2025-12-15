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
        Schema::create('user_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->boolean('system')->default(false);
        });

        \App\Models\UserRole::create([
            'id' => 1,
            'name' => 'User',
            'description' => 'Пользователь, ограничение в доступе',
            'system' => 1
        ]);
        \App\Models\UserRole::create([
            'id' => 500,
            'name' => 'Moderator',
            'description' => 'Модератор, ограниченный доступ.',
            'system' => 0
        ]);
        \App\Models\UserRole::create([
            'id' => 900,
            'name' => 'Администратор',
            'description' => 'Администратор, полный доступ',
            'system' => 1
        ]);


        \App\Models\UserRole::create([
            'id' => 999,
            'name' => 'Developer',
            'description' => 'Разработчик',
            'system' => 1
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_roles');
    }
};
