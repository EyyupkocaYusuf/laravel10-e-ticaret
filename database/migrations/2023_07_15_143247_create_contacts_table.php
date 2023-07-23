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
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name',25)->nullable();
            $table->string('surname',25)->nullable();
            $table->string('email',30)->nullable();
            $table->string('subject',90)->nullable();
            $table->text('message')->nullable();
            $table->string('ip')->nullable();
            $table->enum('status',['0','1'])->nullable()->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
