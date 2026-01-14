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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('car_categories')->onDelete('cascade');
            $table->string('name');
            $table->string('model');
            $table->integer('year');
            $table->decimal('price_per_day', 10, 2);
            $table->string('image')->nullable();
            $table->json('images')->nullable();
            $table->text('description')->nullable();
            $table->json('features')->nullable();
            $table->integer('seats')->default(5);
            $table->string('transmission')->default('automatic');
            $table->string('fuel_type')->default('petrol');
            $table->boolean('is_available')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->boolean('is_most_searched')->default(false);
            $table->integer('search_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
