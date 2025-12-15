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
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')

                ->onUpdate('cascade');


            $table->unsignedBigInteger('region_id')->nullable();
            $table->foreign('region_id')
                ->references('id')
                ->on('regions')

                ->onUpdate('cascade');

            $table->string('name')->nullable();
            $table->string('postal_code',100)->nullable();



        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
};
