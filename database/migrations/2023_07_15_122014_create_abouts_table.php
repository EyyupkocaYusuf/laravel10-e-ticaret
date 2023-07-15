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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->string('title',100)->nullable();
            $table->text('content')->nullable();
            $table->string('image',200)->nullable();


            $table->text('text_1_icon')->nullable();
            $table->string('text_1',50)->nullable();
            $table->text('text_1_content')->nullable();

            $table->text('text_2_icon')->nullable();
            $table->string('text_2',50)->nullable();
            $table->text('text_2_content')->nullable();

            $table->text('text_3_icon')->nullable();
            $table->string('text_3',50)->nullable();
            $table->text('text_3_content')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abouts');
    }
};
