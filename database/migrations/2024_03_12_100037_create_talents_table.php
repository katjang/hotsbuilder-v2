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
        Schema::create('talents', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_id')->constrained();
            $table->string('name');
            $table->text('description');
            $table->string('image');
            $table->string('ability');
            $table->unsignedInteger('sort');
            $table->unsignedInteger('cooldown')->nullable();
            $table->unsignedInteger('mana_cost')->nullable();
            $table->unsignedInteger('level');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('talents');
    }
};
