<!DOCTYPE html>
<html>
<head>
    <title>Notificación de Cancelación de Reserva</title>
</head>
<body>
    <h2>Hola,</h2>
    <p>
        La reserva de {{ $reservation->firstName }} para el {{ $reservation->date }} ha sido cancelada.
    </p>
    <p>Detalles de la reserva:</p>
    <ul>
    <li>ID: {{ $reservationDetails->id }}</li>
        <li>Nombre: {{ $reservationDetails->firstName }}</li>
        <li>Personas: {{ $reservationDetails->people }}</li>
        <li>Fecha: {{ $reservationDetails->date }}</li>
        <li>Hora: {{ $reservationDetails->time }}</li>
        <li>Email: {{ $reservationDetails->email }}</li>
        <li>Teléfono: {{ $reservationDetails->phone }}</li>
        <li>Alergias: {{ $reservationDetails->allergies }}</li>
    </ul>
    <p>Gracias,</p>
    <p>Restaurante Pinocho</p>
</body>
</html>