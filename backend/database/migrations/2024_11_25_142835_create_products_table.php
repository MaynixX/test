<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('alias')->nullable(false)->unique();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->foreignId('nomenclature_id')->constrained()->onDelete('cascade');
            $table->text('tags')->nullable();
            $table->string('preview_image')->nullable();
            $table->text('description')->nullable();
            $table->integer('access_level')->default(0);
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->boolean('is_active')->default(true);
            $table->string('gift')->nullable();
            $table->timestamps();
        });


        
    }

    public function down()
    {
        Schema::dropIfExists('documents');
    }
};
