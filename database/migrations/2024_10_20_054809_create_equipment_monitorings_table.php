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
        Schema::create('equipment_monitorings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('staff_user_id')->constrained('users');
            $table->foreignId('equipment_id')->constrained('equipments');
            $table->dateTime('monitoring_date');
            $table->integer('equipment_status');
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
        Schema::dropIfExists('equipment_monitorings');
    }
};
