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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false); // Название свойства
            $table->string('alias')->nullable(false)->unique(); // Алиас
            $table->foreignId('data_type_id')->constrained('data_types')->onDelete('cascade'); // Тип данных (связь с справочником типов данных)
            $table->integer('sort_order')->default(0); // Порядок сортировки
            $table->boolean('is_multiple')->default(false); // Множественное
            $table->boolean('is_selector')->default(false); // Селектор
            $table->boolean('show_in_characteristics')->default(false); // Показывать в характеристиках
            $table->boolean('show_in_filters')->default(false); // Показывать в фильтрах
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
