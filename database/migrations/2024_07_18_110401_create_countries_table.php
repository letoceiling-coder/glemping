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
        Schema::create('countries', function (Blueprint $table) {
            $table->id();
            $table->string('en')->nullable();
            $table->string('ru')->nullable();
            $table->string('ja')->nullable();
            $table->string('ko')->nullable();
            $table->string('fr')->nullable();
            $table->string('es')->nullable();
            $table->string('de')->nullable();
            $table->string('zh')->nullable();
            $table->string('country_code',10)->nullable();
            $table->string('currency_code',3)->nullable();
            $table->string('lang_code',2)->nullable();
            $table->integer('sort')->default(100);
            $table->boolean('active')->default(true);
            $table->tinyInteger('version');






        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
