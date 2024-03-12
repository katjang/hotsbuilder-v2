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
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hero_id')->constrained();
            $table->string('name');
            $table->string('title');
            $table->text('description');
            $table->text('icon')->nullable();
            $table->string('hotkey')->nullable();
            $table->unsignedInteger('cooldown')->nullable();
            $table->unsignedInteger('mana_cost')->nullable();
            $table->boolean('trait');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('abilities');
    }
};
