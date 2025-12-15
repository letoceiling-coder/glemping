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
        Schema::create('number_guests', function (Blueprint $table) {
            $table->id();
            $table->integer('guest');
            $table->integer('increase')->default(7);
        });

        \App\Models\NumberGuests::create([
            'guest' => 15785
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('number_guests');
    }
};
