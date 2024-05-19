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
        <p>Le recordamos que la mesa la guardamos 15 min. Si no pudiese venir rogamos que cancele su reserva</p>
            <p>¡Te esperamos en Restaurante Pinocho!</p>
            <p>Gracias por confiar en nosotros</p>
          
        </div>
</body>
</html>


