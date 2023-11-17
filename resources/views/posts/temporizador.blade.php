<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Countdown</title>
    <link rel="stylesheet" href="style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Share+Tech+Mono&display=swap" rel="stylesheet">

    <link href="{{ asset('csspersonalizados/contador.css')}}"  rel="stylesheet" />   
</head>
<body>
    <section class="container">
        <h1>¡NAVIDAD¡</h1>
        <div class="countdown">
            <div>
                <p id="days">0</p>
                <span>Dias</span>
            </div>
            <div>
                <p id="hours">0</p>
                <span>Horas</span>
            </div>
            <div>
                <p id="minutes">0</p>
                <span>Minutos</span>
            </div>
            <div>
                <p id="seconds">0</p>
                <span>Segundos</span>
            </div>
        </div>
    </section>
    {{-- <section class="final-sms"><h2>¡FELIZ NAVIDAD¡ 🎅🏼 </h2></section> --}}
    <script src="{{ asset('jspersonalizados/temporizador.js')}}"></script>
      
</body>
</html>