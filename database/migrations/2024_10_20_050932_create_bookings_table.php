<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_user_id')->constrained('users');
            $table->foreignId('staff_user_id')->constrained('users');
            $table->foreignId('service_id')->constrained('services');
            $table->integer('transaction_status');
            $table->dateTime('booking_date');
            $table->dateTime('booking_schedule');
            $table->dateTime('pickup_schedule');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bookings');
    }
};
