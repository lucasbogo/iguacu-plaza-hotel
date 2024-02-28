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
        Schema::create('cash_register_payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cashier_closing_record_id')->constrained()->onDelete('cascade');
            $table->foreignId('receptionist_id')->constrained()->onDelete('cascade');
            $table->decimal('rent_amount', 10, 2)->nullable();
            $table->decimal('drink_amount', 10, 2)->nullable();
            $table->decimal('room_service_amount', 10, 2)->nullable();
            // Add more fields as needed (e.g., credit_amount, debit_amount, pix_amount)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cash_register_payments');
    }
};
