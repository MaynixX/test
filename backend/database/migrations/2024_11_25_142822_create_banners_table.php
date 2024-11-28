<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->enum('format', ['image', 'html_block_1', 'html_block_2', 'html_block_3'])->nullable(false);
            $table->string('mobile_image')->nullable()->default(null);
            $table->string('desktop_image')->nullable()->default(null);
            $table->text('html_content')->nullable();
            $table->string('url')->nullable(false);
            $table->integer('order')->default(0);
            $table->dateTime('publish_date')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('banner_office', function (Blueprint $table) {
            $table->id();
            $table->foreignId('banner_id')->constrained()->onDelete('cascade');
            $table->foreignId('office_id')->constrained()->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('banner_office');
        Schema::dropIfExists('banners');
    }
};
