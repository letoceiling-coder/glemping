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
        Schema::create('images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('folder_id');
            $table->foreign('folder_id')->references('id')
                ->on('folders')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->unsignedBigInteger('was_folder_id')->nullable();
            $table->foreign('was_folder_id')->references('id')
                ->on('folders')
                ->onDelete('cascade')
                ->onUpdate('cascade');


            $table->string('name');
            $table->string('extension',5);
            $table->string('disk')->default('uploads');

            $table->string('path')->unique();
            $table->boolean('temporary')->default(false);
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->bigInteger('preview_id')->nullable();
//            $table->timestamps();
//            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('images');
    }
};
