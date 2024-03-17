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
        Schema::create('room_transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('occupant_id')->constrained()->onDelete('cascade');
            $table->integer('old_rental_unit_id')->constrained('rental_units')->onDelete('cascade');
            $table->integer('new_rental_unit_id')->constrained('rental_units')->onDelete('cascade');
            $table->date('transfer_date');
            $table->text('transfer_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('room_transfers');
    }
};
