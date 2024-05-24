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
            <p>Este mensaje y su archivos adjuntos van dirigidos exclusivamente a su destinatario, pudiendo contener información confidencial sometida a secreto profesional.<br>No está permitida su reproducción o distribución sin la autorización de la empresa LAURA BERMEJO DEL CASTILLO. Si usted no es el destinatario final por favor eliminelo e infórmenos al correo: laurabdc@icloud.com <br>Le informamos que tratamos sus datos personales con la finalidad de realizar la gestión administrativa, contable y fiscal, así como enviarle comunicaciones comerciales sobre nuestros productos y/o servicios.<br>Los datos proporcionados se conservarán mientras se mantenga la relación comercial o durante los años necesarios para cumplir con las obligaciones legales. Los datos no se cederán a terceros salvo en los casos que exista la obligación legal.<br> Así mismo, le informamos de la posibilidad de ejercer los siguientes derechos sobre sus datos personales: derecho de acceso, rectificación, supresión u olvido, limitación, oposición, portabilidad y a restirar el consentimiento prestado.<br> Para ello podrá enviar un email a: ldelcastillo@live.com.<br> Además, el interesado puede dirigirse a la autoridad de control en medida de protección de datos competente para obtener información.<br> Si usted no desea recibir nuestra información, pónfase en contacti con nosotros enviando un correo a la siguiente dirección: ldelcastillo@live.com<br>Datos identificativos<br> BERMEJO DEL CASTILLO, LAURA, 72986950s, C/SAN RAFAEL, 27 LOCAL-50017-ZARAGOZA-ZARAGOZA, 659196212</p>
        </div>
</body>
</html>