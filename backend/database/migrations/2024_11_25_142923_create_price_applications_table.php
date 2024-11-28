<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('price_applications', function (Blueprint $table) {
            $table->id();
            $table->string('full_name')->nullable(false);
            $table->string('city')->nullable();
            $table->string('clinic_name')->nullable();
            $table->string('email')->nullable(false);
            $table->string('phone')->nullable(false);
            $table->boolean('consent')->default(false);
            $table->timestamps();
        });

        Schema::create('price_application_documents', function (Blueprint $table) {
            $table->id();
            $table->string('file_name')->nullable(false);
            $table->foreignId('price_application_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('price_application_documents');
        Schema::dropIfExists('price_applications');
    }
};
