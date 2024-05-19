<!DOCTYPE html>
<html>
<head>
    <title>Reserva Cancelada</title>
</head>
<body>
    <h2>Hola, {{ $reservation->firstName }}</h2>
    <p>
        Ha cancelado su reserva para el {{ $reservation->date }} con éxito.
    </p>
    <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>
    <p>Gracias,</p>
    <p>Restaurante Pinocho</p>
</body>
</html>