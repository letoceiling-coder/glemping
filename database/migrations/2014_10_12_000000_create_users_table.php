<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('role_id')->default(1);

            $table->foreign('role_id')
                ->references('id')
                ->on('user_roles')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->string('name');
            $table->string('phone',20)->nullable();;
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->boolean('subscription')->default(false);

            $table->rememberToken();
            $table->timestamps();
        });

        $password = 123123123;
        User::create([
            'name' => 'ADMIN',
            'surname' => 'ADMIN',
            'email' => "dsc-23@yandex.ru",
            'password' => Hash::make($password),
            'role_id' => 999
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
