<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('slug')->unique();

            $table->string('title');
            $table->string('head')->nullable();
            $table->text('description')->nullable();

            $table->json('data')->nullable();

            $table->boolean('publish')->default(false);
            $table->boolean('active')->default(true);
            $table->timestamps();
        });
        \App\Models\Page::create([
            "id" => 1,
            "name" => "Авторизация",
            "slug" => "/login",
            "title" => "Авторизация",
            "head" => "Авторизация",
            "description" => "Авторизация",
            "data" => [
                0 => [
                    "sort" => 0,
                    "setting" => [
                        "id" => 2,
                        "isOpen" => true,
                        "container" => "container",
                        "marginTop" => "mt-3",
                        "components" => [
                            [
                                "id" => "7571b533ac8b1",
                                "name" => "Авторизация",
                                "path" => "/resources/js/src/Views/Auth/Login/",
                                "sort" => 0,
                                "view" => [],
                                "fields" => [],
                                "preview" => null,
                                "category" => [],
                                "component" => "Login",
                            ]
                        ],
                        "marginBottom" => "mb-0",
                    ]
                ]
            ],
            "publish" => false,
            "active" => true,
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};
