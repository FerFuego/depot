<html>
    <head>
        <style>
            html,
            body {
                height: 100vh;
                background-image: url('http://depotsoftware.ar/img/banner-1.png');
                background-size:  100%;
                background-repeat: no-repeat;
            }
            h3{
                display: block;
                font-size: 90px;
                text-align: center;
                margin-top: 200px;
                margin-bottom: 0;
                width: 100%;
            }
            p {
                display: block;
                font-size: 40px;
                text-align: center;
                width: 100%;
                padding: 0 15%
            }
        </style>
    </head>
    <body>
        <h3>{{ $booking->supplier }}</h3>
        {{-- <p><b>Dia:</b> {{ $booking->day }}</p>
        <p><b>Tiempo disponible:</b> {{ $booking->time }}min</p>
        <p><b>Horario:</b> {{ \Carbon\Carbon::parse($booking->start)->format('h:i:s A') }}</p> --}}
        <p>Turno reservado para el dia: {{  \Carbon\Carbon::parse($booking->start)->format('d-m-Y') }} </p> 
        <p>De {{  \Carbon\Carbon::parse($booking->start)->format('H:i') ." a ". \Carbon\Carbon::parse($booking->end)->format('H:i') ." - ". $booking->time ."min" }}</p>
    </body>
</html>