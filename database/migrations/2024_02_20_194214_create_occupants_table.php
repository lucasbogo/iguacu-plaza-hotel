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
        Schema::create('occupants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_unit_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->date('check_in');
            $table->date('check_out')->nullable();
            $table->decimal('rent_amount', 10, 2);
            $table->date('payment_date');
            $table->date('transfer_date')->nullable();
            $table->text('transfer_reason')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('occupants');
    }
};
