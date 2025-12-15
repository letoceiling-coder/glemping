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
        Schema::create('offers', function (Blueprint $table) {
            $table->id();

            $table->integer('uid')->nullable();

            $table->string('name');
            $table->text('description');
            $table->integer('price');

            $table->boolean('active')->default(true);
            $table->integer('pos_x')->default(0);
            $table->integer('pos_y')->default(0);
            $table->integer('width')->default(217);
            $table->integer('height')->default(128);

            $table->integer('image_id')->default(1);


            $table->integer('places')->default(2); // мест
            $table->integer('dop')->default(0); // мест доп
            $table->integer('square')->default(15); //площадь
            $table->json('info')->nullable(); //info
            $table->json('additionally')->nullable(); //дополнительно


            $table->timestamps();
        });

        Schema::create('offer_option', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Offer::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Option::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


        });

        Schema::create('image_offer', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Offer::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Image::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


        });

        Schema::create('offer_service', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Offer::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Service::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


        });

        Schema::create('booking_offer', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Offer::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Booking::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();


        });

        Schema::create('property_offer', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Offer::class)
                ->constrained()
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreignIdFor(\App\Models\Property::class)
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
        Schema::dropIfExists('offers');
    }
};
