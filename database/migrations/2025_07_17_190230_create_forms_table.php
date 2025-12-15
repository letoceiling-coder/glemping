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
        Schema::create('forms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('method')->unique();
            $table->string('size',20)->nullable();
            $table->boolean('popup')->default(true);
            $table->boolean('logo')->default(true);
            $table->boolean('bitrix')->default(true);
            $table->boolean('save')->default(true);
            $table->boolean('statement')->default(true);
            $table->json('statement_text')->nullable();

            $table->boolean('active')->default(true);
            $table->integer('sort')->default(0);
            $table->json('data')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forms');
    }
};
