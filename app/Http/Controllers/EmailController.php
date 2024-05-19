<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use Illuminate\Support\Facades\Mail;

class EmailController extends Controller
{
    public function sendWelcomeEmail()
    {
        $title = 'Restaurante Pinocho';
        $body = 'Gracias, su reserva será confirmada en breves';

        Mail::to('your-recipient@domain.com')->send(new ReservationConfirmation($title, $body));

        return "Rescibirá un correo con su reserva!";
    }
}
