<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactMailController extends Controller
{
    public function send(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $to = env('OWNER_EMAIL');
        $subject = 'Nuevo mensaje de contacto de ' . $data['name'];

        $emailData = [
            'title' => $subject,
            'body' => $data['message'],
            'name' => $data['name'],
            'email' => $data['email']
        ];
      
        Mail::send('emails.contact', $emailData, function ($message) use ($to, $subject, $data) {
            $message->from($data['email'], $data['name'])
                 ->to($to)
                 ->subject($subject);
        });

        return response()->json(['message' => 'Correo enviado correctamente.']);
    }
}