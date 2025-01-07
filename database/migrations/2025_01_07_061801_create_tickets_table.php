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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_id', 50);
            $table->string('patient_id', 50);
            $table->string('department_id', 50);
            $table->string('time_slot_id', 50);
            $table->date('date');
            $table->integer('payment_amount')->default(0);
            $table->integer('payment_status')->default(0)->comment('0 = pending, 1 = payment success')->nullable();
            $table->string('transection_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
