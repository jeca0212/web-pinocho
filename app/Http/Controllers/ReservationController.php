<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservation;
use App\Models\User; 
use Illuminate\Support\Facades\Mail; // Importa la fachada Mail si es necesario
use App\Mail\ReservationConfirmation; // Importa tu Mailable de confirmación de reserva
use App\Mail\OwnerReservationNotification;
use App\Mail\ReservationCancellation;
use App\Mail\OwnerCancellationNotification;
use Illuminate\Support\Facades\DB;

class ReservationController extends Controller
{
    public function store(Request $request)
    {
        // Obtén la fecha de la reserva del request
        $reservationDate = $request->input('date');
    
        // Calcula el total de personas reservadas para la fecha de la reserva
        $totalReserved = Reservation::whereDate('date', $reservationDate)->sum('people');
        $newReservation = $request->people;
    
        if (($totalReserved + $newReservation) > 75) {
            return response()->json(['message' => 'Not enough space for this reservation.'], 422);
        }
    
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'people' => 'required|integer|min:1',
            'date' => 'required|date',
            'phone' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'time' => 'required',
            'allergies' => 'nullable|string',
        ]);
    
        $reservation = new Reservation($validated);
    
        // Asignar valores a score y status
        $reservation->score = 5;
        $reservation->status = 'pendiente';
        $reservation->save();
    
        Mail::to($validated['email'])->send(new ReservationConfirmation($reservation)); // Usa el email de la solicitud
    
        $ownerEmail = env('OWNER_EMAIL');
        Mail::to($ownerEmail)->send(new OwnerReservationNotification($reservation));
    
        return response()->json(['message' => 'Reservation successfully created.']);
    }
    public function index(Request $request)
    {
        $query = Reservation::query();

    if ($request->has('status')) {
        $query->where('status', $request->status);
    }

    if ($request->has('filter')) {
        $query->where('phone', $request->filter)
            ->orWhere('email', $request->filter);
    }

    $reservations = $query->get();
    return response()->json($reservations);
}

public function show($id)
{
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return response()->json(['error' => 'Reserva no encontrada'], 404);
    }

    return response()->json($reservation);
}

public function getAceptadas()
{
    return Reservation::where('status', 'aceptado')->get();
}

public function getRechazadas()
{
    return Reservation::where('status', 'cancelado')->get();
}

public function accept(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->status = 'aceptado';
    $reservation->visible = true;
    $reservation->score = $request->score ?? 5; 

    $saved = $reservation->save();

    if (!$saved) {
        Log::info("No se pudo guardar la reserva con id: $id");
        return response()->json(['message' => 'No se pudo actualizar la reserva'], 500);
    }

    $ownerEmail = env('OWNER_EMAIL');
    $clientEmail = $reservation->email;
    $reservationDetails = Reservation::findOrFail($id);

    $data = [
        'title' => 'Reserva Aceptada',
    'body' => 'Tu reserva ha sido aceptada.',
    'reservationDetails' => $reservationDetails,
    
    ];


    Mail::send('emails.pinocho', $data, function($message) use ($ownerEmail, $clientEmail) {
        $message->to($ownerEmail)
                ->subject('Reserva Aceptada');
        $message->to($clientEmail)
                ->subject('Reserva Aceptada');
    });
   

    return response()->json($reservation, 200);
}

public function cancel(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);

    $reservation->status = 'cancelado';
    $reservation->visible = false;
    $saved = $reservation->save();

    if (!$saved) {
        Log::info("No se pudo guardar la reserva con id: $id");
        return response()->json(['message' => 'No se pudo actualizar la reserva'], 500);
    }

    $ownerEmail = env('OWNER_EMAIL');
    $clientEmail = $reservation->email;
    $reservationDetails = Reservation::findOrFail($id);

    $data = [
        'title' => 'Reserva Cancelada',
        'body' => 'Tu reserva ha sido cancelada.',
        'reservationDetails' => $reservationDetails
    ];

    Mail::send('emails.pinochoCancel', $data, function($message) use ($ownerEmail, $clientEmail) {
        $message->to($ownerEmail)
                ->subject('Reserva Cancelada');
        $message->to($clientEmail)
                ->subject('Reserva Cancelada');
    });

    return response()->json($reservation, 200);
}

    public function update(Request $request, $id)
    {
        // Buscar la reserva por ID
        $reservation = Reservation::findOrFail($id);

        $validated = $request->validate([
            'score' => 'required|integer|min:1|max:5',

        ]);

        $reservation->update($validated);



        return response()->json(['message' => 'Reserva actualizada con éxito', 'reservation' => $reservation]);
    }

    public function updateScore(Request $request, $id)
{
    $reservation = Reservation::findOrFail($id);
    

    $newScore = $request->input('score');
    $reservation->score = $newScore;

    $saved = $reservation->save();

    if (!$saved) {
        Log::info("No se pudo actualizar el score de la reserva con id: $id");
        return response()->json(['message' => 'No se pudo actualizar el score de la reserva'], 500);
    }

    return response()->json($reservation, 200);
}

public function checkScore(Request $request)
{
    $validated = $request->validate([
        'firstName' => 'required|string|max:255',
        'people' => 'required|integer|min:1',
        'date' => 'required|date',
        'phone' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'time' => 'required',
        'allergies' => 'nullable|string',
    ]);

    $reservation = DB::table('reservations')->where('email', $validated['email'])->where('phone', $validated['phone'])->first();

    // Si no se encuentra una reserva, crea una nueva y permite la reserva
    if (!$reservation) {
        $newReservation = new Reservation;
        $newReservation->firstName = $validated['firstName'];
        $newReservation->people = $validated['people'];
        $newReservation->date = $validated['date'];
        $newReservation->phone = $validated['phone'];
        $newReservation->email = $validated['email'];
        $newReservation->time = $validated['time'];
        $newReservation->allergies = $validated['allergies'];
        $newReservation->score = 5; // Añade un valor para score
        $newReservation->status = 'pendiente'; // Añade un valor para status
        $newReservation->save();

        return response()->json(['canReserve' => true]);
    }

    // Comprueba la puntuación de la reserva
    if ($reservation->score >= 3) {
        return response()->json(['canReserve' => true]);
    } else {
        return response()->json(['canReserve' => false]);
    }
}



    public function getReservations()
    {
        $reservations = Reservation::where('visible', true)->get();
        return response()->json($reservations, 200);
    }



    

public function destroy($id)
{
    // Buscar la reserva por ID
    $reservation = Reservation::findOrFail($id);

    // Eliminar la reserva
    $reservation->delete();

    return response()->json(['message' => 'Reservation successfully deleted.']);
}
public function cancelByClient($id)
{
    $reservation = Reservation::find($id);

    if (!$reservation) {
        return response()->json(['message' => 'Reservation not found.'], 404);
    }

    $reservation->status = 'cancelado';
    $reservation->save();

    // Enviar correo electrónico de cancelación al cliente
    Mail::to($reservation->email)->send(new ReservationCancellation($reservation));

    // Enviar correo electrónico de notificación de cancelación al propietario
    $ownerEmail = env('OWNER_EMAIL');
    Mail::to($ownerEmail)->send(new OwnerCancellationNotification($reservation));

    return response()->json(['message' => 'Reservation successfully cancelled.']);
}

}