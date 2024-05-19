<!DOCTYPE html>
<html>
<head>
    <title>{{ $title }}</title>
</head>
<body>
    <h1>{{ $title }}</h1>
    <p>{{ $body }}</p>
    <h2>Detalles de la reserva:</h2>
    <li>Nombre: {{ $reservationDetails->firstName }}</li>
    <li>Personas: {{ $reservationDetails->people }}</li>
        <li>Teléfono: {{ $reservationDetails->phone }}</li>
        <li>Día: {{ $reservationDetails->date }}</li>
        <li>Email: {{ $reservationDetails->email }}</li>
        <li>Hora: {{ $reservationDetails->time }}</li>
        <li>Alergias o intolerancias: {{ $reservationDetails->allergies }}</li>
        <div>
       
            <p>Gracias por confiar en nosotros</p>
          
        </div>
</body>
</html>