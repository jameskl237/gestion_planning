<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title></title>
</head>
<body>
    <div class="d-flex flex-row mt-5">


        <!-- DEVISE EN FRANCAIS -->
        <div class="text-center" style="margin-bottom:30px; flex:1">

            <div>
                <h4 class="fw-bold text-uppercase">république du cameroun</h4>
                <h5><i>Paix - travail - Patrie</i></h5>
                <h6>- . - . - . -</h6>
            </div>

            <div>
                <h4 class="fw-bold text-uppercase">université de yaoundé i</h4>
                <h5 class="fw-bold">Faculté des sciences</h5>
                <h5><i>Département d'informatique</i></h5>
                <h6><i>B.P 812 Yaoundé</i></h6>
            </div>

        </div>

        <!-- LOGO UNIVERSITE -->
        <div class="text-center" style="margin-bottom:50px; flex:1;
        display: flex;
        align-content: center;
        justify-content: center;">
        {{-- reglage de la taille du logo --}}
            <img src="{{ asset('images/logo_universite.png') }}" width="130" alt="" srcset="">
        </div>

        <!-- DEVISE EN ANGLAIS -->
        <div class="text-center" style="margin-bottom:30px; flex:1">

            <div>
                <h4 class="fw-bold text-uppercase">Republic of Cameroon</h4>
                <h5><i>Peace - Work - Fatherland</i></h5>
                <h6>- . - . - . -</h6>
            </div>

            <div>
                <h4 class="fw-bold text-uppercase">University of Yaoundé I</h4>
                <h5 class="fw-bold">Faculty of Science</h5>
                <h5><i>Department of Computer Science</i></h5>
                <h6><i>P.O. Box 812 Yaoundé</i></h6>
            </div>

        </div>
    </div>
</body>
</html>
