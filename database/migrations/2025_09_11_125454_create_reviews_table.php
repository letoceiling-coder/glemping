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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();

        });

        Schema::create('image_review', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Review::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Image::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('options');
        Schema::dropIfExists('review_image');
    }
};
