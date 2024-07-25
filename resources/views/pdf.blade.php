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

    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            {{-- @php
                                $planning = App\Models\Planning::find($id);
                            @endphp --}}

                            <h4>{{ $planning->name }}</h4>
                        
                                <button type="submit" class="btn btn-primary"  id="generatePdf"><a href="{{ route('pdf',$id) }}">Générer PDF</a></button>
                          
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Ajoutez une nouvelle tache
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div id="tableExport_wrapper"
                                    class="dataTables_wrapper container-fluid dt-bootstrap4 no-footer">
                                    <table class="table table-striped table-hover dataTable no-footer" id="tableExport"
                                        style="width: 100%;" role="grid" aria-describedby="tableExport_info">
                                        <thead>
                                            <tr role="row">
                                                <th class="sorting_asc" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1" aria-sort="ascending"
                                                    aria-label="Name: activate to sort column descending"
                                                    style="width: 89px;">Heure

                                                </th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 140px;">Lundi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 61px;">Mardi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">Mercredi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">Jeudi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">Vendredi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">samedi</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">Dimanche</th>
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
                                                            @endphp
                                                            <a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                {{ $t->name }}<br>
                                                                {{ $t->description }}<br>
                                                                <br>salle:
                                                                @if ($s)
                                                                    {{ $s->name }}
                                                                @else
                                                                    Nom de la salle non disponible
                                                                @endif
                                                            </a>
                                                            <div class="d-flex">
                                                                <a class="btn btn-primary btn-action mr-1"
                                                                   onclick="edit_tache({{ $t->id }});" title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                   onclick="delete_tache({{ $t->id }});">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
</html>
