<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateDataTypesTable extends Migration
{
    public function up()
    {
        Schema::create('data_types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false); // Название типа данных
            $table->string('short_name')->nullable(); // Сокращение
            $table->string('alias')->nullable(false)->unique(); // Алиас
            $table->string('type')->nullable(false); // Тип данных
            $table->string('validation')->nullable(false); // Тип данных
            $table->timestamps();
        });

        // Предустановленные типы данных
        DB::table('data_types')->insert([
            ['name' => 'Строка', 'short_name' => 'стр', 'alias' => 'string', 'type' => 'string', 'validation' => 'string'],
            ['name' => 'Текст', 'short_name' => 'текст', 'alias' => 'text', 'type' => 'text', 'validation' => 'string'],
            ['name' => 'Целое число', 'short_name' => 'цел', 'alias' => 'integer', 'type' => 'integer', 'validation' => 'integer'],
            ['name' => 'Дробное число', 'short_name' => 'дроб', 'alias' => 'float', 'type' => 'float', 'validation' => 'numeric'],
            ['name' => 'Булевый', 'short_name' => 'бул', 'alias' => 'boolean', 'type' => 'boolean', 'validation' => 'boolean'],
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('data_types');
    }
}
