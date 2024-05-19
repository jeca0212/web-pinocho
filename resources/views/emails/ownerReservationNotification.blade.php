<!DOCTYPE html>
<html>
<head>
    <title>Nueva Reserva</title>
</head>
<body>
    <h2>Tienes una nueva reserva</h2>
    <p>Detalles de la reserva:</p>
    <ul>
        <!-- <li>ID: {{ $reservationDetails->id }}</li> -->
        <li>Nombre: {{ $reservationDetails->firstName }}</li>
        <li>Personas: {{ $reservationDetails->people }}</li>
        <li>Fecha: {{ $reservationDetails->date }}</li>
        <li>Hora: {{ $reservationDetails->time }}</li>
        <li>Email: {{ $reservationDetails->email }}</li>
        <li>Teléfono: {{ $reservationDetails->phone }}</li>
        <li>Alergias: {{ $reservationDetails->allergies }}</li>
    </ul>
    <p>Puedes ver más detalles en el siguiente enlace:</p>
    <a href="http://localhost:3000/homeDashboard">Ver Reserva</a>
</body>
</html>