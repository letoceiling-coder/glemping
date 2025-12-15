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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            $table->string('en')->nullable();
            $table->string('ru')->nullable();
            $table->string('ja')->nullable();
            $table->string('ko')->nullable();
            $table->string('fr')->nullable();
            $table->string('es')->nullable();
            $table->string('de')->nullable();
            $table->string('zh')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->tinyInteger('active')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};
