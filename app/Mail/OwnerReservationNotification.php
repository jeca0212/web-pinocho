<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;

class OwnerReservationNotification extends Mailable
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
            ->subject('Nueva reserva en Restaurante Pinocho')
            ->view('emails.ownerReservationNotification')
            ->with([
                'reservationDetails' => $this->reservation
            ]);
    }
}

