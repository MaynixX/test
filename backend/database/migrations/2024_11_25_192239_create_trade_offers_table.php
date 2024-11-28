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
        Schema::create('trade_offers', function (Blueprint $table) {
            $table->id(); // ID торгового предложения
            $table->string('title')->nullable(false); // Название
            $table->string('alias')->nullable(false)->unique(); // Алиас
            $table->foreignId('product_id')->constrained('products')->onDelete('cascade'); // Привязка к товару
            $table->string('preview_image')->nullable(); // Фото-превью
            $table->string('sku')->nullable(false)->unique(); // Артикул
            $table->decimal('price', 10, 2)->nullable(false); // Цена базовая
            $table->decimal('old_price', 10, 2)->nullable(); // Цена до скидки
            $table->boolean('is_active')->default(true); // Активность
            $table->timestamps(); // Дата создания и изменения
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trade_offers');
    }
};
