<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du Temps</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            text-align: center;
        }

        .header {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-bottom: 2px solid black;
        }

        .header-left,
        .header-right {
            width: 30%;
            text-align: left;
        }

        .header-center {
            width: 40%;
            text-align: center;
        }

        .header p {
            margin: 5px 0;
            font-size: 12px;
        }

        .title {
            margin: 20px 0;
        }

        .title h2,
        .title h3 {
            margin: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid black;
            padding: 10px;
            text-align: center;
            font-size: 12px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            border-top: 2px solid black;
            margin-top: 20px;
        }

        .footer-left,
        .footer-right {
            width: 30%;
            text-align: center;
        }

        .footer-center {
            width: 40%;
            text-align: center;
        }

        .footer p {
            margin: 0;
            font-size: 12px;
        }

        img {
            height: 80px;
            width: auto;
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-left">
            <p>REPUBLIQUE DU CAMEROUN<br>Paix – Travail – Patrie</p>
            <p>UNIVERSITÉ DE YAOUNDÉ I<br>Faculté des Sciences<br>Département d'Informatique<br>B.P. 812 Yaoundé</p>
        </div>
        <div class="header-center">
            <img src="public/images/logoblack.jpeg" alt="University Logo">
        </div>
        <div class="header-right">
            <p>REPUBLIC OF CAMEROON<br>Peace – Work – Fatherland</p>
            <p>UNIVERSITY OF YAOUNDÉ I<br>Faculty of Sciences<br>Department of Computer Science<br>P.O.Box 812 Yaoundé</p>
        </div>
    </div>
    <div class="title">
        <h2>EMPLOI DU TEMPS</h2>
        <h3>SEMESTRE 2_ ANNEE ACADEMIQUE 2023-2024</h3>
        <h3>FILIERE ICT4D-ICTL3</h3>
        <h3>SALLE: S107</h3>
    </div>
    <table>
        <thead>
            <tr>
                <th>Horaire</th>
                <th>Lundi</th>
                <th>Mardi</th>
                <th>Mercredi</th>
                <th>Jeudi</th>
                <th>Vendredi</th>
                <th>Samedi</th>
                <th>Dimanche</th>
            </tr>
        </thead>
        <tbody>
            @php
                $tasksByTime = [];
                foreach ($task as $t) {
                    $timeKey = $t->heure_debut . ' - ' . $t->heure_fin;
                    if (!isset($tasksByTime[$timeKey])) {
                        $tasksByTime[$timeKey] = [];
                    }
                    $tasksByTime[$timeKey][$t->jour] = $t;
                }
                $jours = ['Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche'];
            @endphp

            @foreach ($tasksByTime as $time => $days)
                <tr>
                    <td>{{ $time }}</td>
                    @foreach ($jours as $jour)
                        <td>
                            @if (isset($days[$jour]))
                                @php
                                    $t = $days[$jour];
                                    $sa = App\Models\Todo_salle::where('todo_id', $t->id)->first();
                                    $s = null;
                                    if ($sa) {
                                        $s = App\Models\Salle::find($sa->salle_id);
                                    }

                                    $prof = App\Models\Todo_user::where('todo_id', $t->id)->first();
                                    $enseignant = null;
                                    if ($prof) {
                                        $enseignant = App\Models\User::find($prof->user_id);
                                    }
                                @endphp
                                <a>
                                    {{ $t->name }}<br>
                                    {{ $t->description }}<br>
                                    @if ($enseignant)
                                        {{ $enseignant->name }}
                                    @else
                                        No name
                                    @endif
                                    <br>salle:
                                    @if ($s)
                                        {{ $s->name }}
                                    @else
                                        Nom de la salle non disponible
                                    @endif
                                </a>
                            @endif
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="footer">
        <div class="footer-left">
            <p>Le Chef de Département</p>
        </div>
        <div class="footer-center">
            <p>Le Vice-Doyen</p>
        </div>
        <div class="footer-right">
            <p>Le Doyen</p>
        </div>
    </div>
</body>

</html>
