<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Reservation;



class OwnerCancellationNotification extends Mailable implements ShouldQueue
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
            ->subject('Una reserva en Restaurante Pinocho ha sido cancelada!')
            ->view('emails.ownerCancellationNotification')
            ->with([
                'reservationDetails' => $this->reservation
            ]);
    }
}