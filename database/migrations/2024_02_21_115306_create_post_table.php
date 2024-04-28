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
        Schema::create('maskanks', function (Blueprint $table) {
            $table->id();
            $table->string('images');
            $table->string('description');
            $table->integer('price');
            $table->string('size');
            $table->integer('bedrooms');
            $table->integer('bathrooms');
            $table->string('region');
            $table->string('city');
            $table->string('floor');
            $table->string('condition');
            $table->integer('status');
            $table->integer('ownerId');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maskanks');
    }
};
