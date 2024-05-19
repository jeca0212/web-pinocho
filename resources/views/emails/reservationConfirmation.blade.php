{{-- resources/views/emails/reservationConfirmation.blade.php --}}
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Confirmación de Reserva</title>
</head>
<body>
    <h1>Confirmación de Reserva</h1>
    <p>Hola {{ $reservationDetails->name }},</p>
    <p>Tu reserva para el {{ $reservationDetails->date }} a las {{ $reservationDetails->time }} será confirmada lo antes posible.</p>
    <p>Detalles de la reserva:</p>
    <ul>
        <li>Nombre: {{ $reservationDetails->firstName }}</li>
        <li>Personas: {{ $reservationDetails->people }}</li>
        <li>Teléfono: {{ $reservationDetails->phone }}</li>
        <li>Día: {{ $reservationDetails->date }}</li>
        <li>Email: {{ $reservationDetails->email }}</li>
        <li>Hora: {{ $reservationDetails->time }}</li>
        <li>Alergias o intolerancias: {{ $reservationDetails->allergies }}</li>
        
    </ul>
    <p>En caso de no poder acudir puede cancelar su reserva en el siguiente enlace:</p>
    <a href="http://localhost:3000/cancelar/{{ $reservationDetails->id }}">Cancelar Reserva</a>
    <p>¡Te esperamos en Restaurante Pinocho!</p>
</body>
</html>