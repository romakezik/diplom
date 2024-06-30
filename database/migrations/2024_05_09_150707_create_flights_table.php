<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('flights', function (Blueprint $table) {
        $table->id();
        $table->foreignId('route_id')->constrained();
        $table->foreignId('car_id')->constrained();
        $table->foreignId('driver_id')->constrained();
        $table->dateTime('departure_datetime');
        $table->integer('available_seats');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flights');
    }
};
