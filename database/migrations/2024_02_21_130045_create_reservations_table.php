<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Reservation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ReservationConfirmation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reservations', function (Blueprint $table) {
        $table->id();
        $table->string('firstName');
        
        $table->integer('people');
        $table->date('date');
        $table->string('phone');
        $table->string('email');
        $table->time('time');
        $table->text('allergies')->nullable();
        $table->unsignedTinyInteger('score')->default(5);
        $table->string('status')->default('pendiente');
        // $table->unsignedBigInteger('user_id');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservations');
    }
};
