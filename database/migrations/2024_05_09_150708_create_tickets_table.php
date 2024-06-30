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
    Schema::create('tickets', function (Blueprint $table) {
        $table->id();
        $table->foreignId('flight_id')->constrained();
        $table->foreignId('entrance_stop_id')->constrained('stops');
        $table->foreignId('exit_stop_id')->constrained('stops');
        $table->foreignId('user_id')->constrained();
        $table->decimal('price', 8, 2);
        $table->string('status');
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
