<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable(false);
            $table->string('alias')->nullable(false)->unique();
            $table->unsignedBigInteger('parent_id')->nullable(false)->default(0);
            $table->text('description')->nullable();
            $table->string('icon')->nullable();
            $table->string('image')->nullable();
            $table->string('seo_title')->nullable();
            $table->string('seo_description')->nullable();
            $table->boolean('add_to_sitemap')->default(false);
            $table->boolean('nofollow')->default(false);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });


    }

    public function down()
    {
        Schema::dropIfExists('properties');
    }
};
