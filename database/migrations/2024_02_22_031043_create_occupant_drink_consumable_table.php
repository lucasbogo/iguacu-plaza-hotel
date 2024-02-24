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
        Schema::create('occupant_drink_consumable', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupant_id')->constrained()->onDelete('cascade');
            $table->foreignId('drink_consumable_id')->constrained()->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->boolean('paid')->default(0).
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupant_drink_consumable');
    }
};
