<?php

namespace App\Mail;

use App\Models\Reservation;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReservationConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $reservation;

    public function __construct(Reservation $reservation)
    {
        $this->reservation = $reservation;
    }

    public function build()
    {
        return $this
            ->subject('Reserva en Restaurante Pinocho')
            ->view('emails.reservationConfirmation')
            ->with([
                'reservationDetails' => $this->reservation
            ]);
    }
}