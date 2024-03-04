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
        Schema::create('cashier_closing_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('receptionist_id')->constrained('receptionists')->onDelete('cascade');
            $table->decimal('start_amount', 10, 2)->default(0.00);
            $table->decimal('end_amount', 10, 2)->default(0.00);
            $table->decimal('total_sales', 10, 2)->default(0.00);
            $table->decimal('total_cash_received', 10, 2)->default(0.00);
            $table->decimal('rental_income', 10, 2)->default(0);
            $table->decimal('drink_income', 10, 2)->default(0);
            $table->decimal('room_service_income', 10, 2)->default(0);
            $table->decimal('quantity_withdrawn', 10, 2)->default(0.00);
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cashier_closing_records');
    }
};
