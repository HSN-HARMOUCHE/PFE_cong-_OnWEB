<!DOCTYPE html>
<html>
<head>
    <style>
        /* Add your CSS styles here */
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            margin: 20px auto;
            max-width: 600px;
            box-shadow: 0px 0px 15px 0px #888888;
        }

        h1 {
            color: #333;
        }

        p {
            font-size: 16px;
        }

        .highlight {
            font-size: 150% ;
            text-decoration: underline;
        }

        .button {
            background-color: #3498db;
            border: none;
            color: #fff;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .button a {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Absence Notification</h1>
        <p>! Un employé a déclaré une absence</p><br>
        <span class="highlight"># {{$mat}}</span><p>   </p><span class="highlight">{{$emply}}</span>
        <hr>
        <p>Date de début : <span class="highlight">{{ $startDate }}</span></p>
        <p>Date de fin : <span class="highlight">{{ $endDate }}</span></p>
        <p>Durée : <span class="highlight">{{ $durée }}</span> jours</p>
        <p>Raisons : <span class="highlight">{{ $raisons }}</span></p>
        <p>Justification : <a class="button" href="http://127.0.0.1:8000/absences">Visitez le site web</a></p>
        <p>Adresse e-mail de l'employé : {{ $emplEmail }}</p>
    </div>
</body>
</html>
