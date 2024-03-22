@extends('layouts.base')

@section('style')
    <!-- Inclure les styles CSS de FullCalendar -->
    <link rel="stylesheet" href="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.css') }}">
    <!-- Inclure le style CSS pour le bouton d'impression -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <style>
        .fc-toolbar .fc-right button:last-child {
            margin-right: 0;
        }
    </style>
@endsection


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Listes des taches</h4>
                            {{-- <form method="get" action="{{ route('pdf', $id) }}"> --}}
                            <button type="button" class="btn btn-primary" id="generatePdf">Générer PDF</button>
                            {{-- </form> --}}
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
                                                    style="width: 89px;">N0</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 140px;">DATE</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 61px;">HORAIRE</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">CODE</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">ENSEIGNANT</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">SALLE</th>
                                            </tr>

                                        </thead>
                                        <tbody>
                                            @foreach ($ta as $t)
                                            <tr>
                                                @php
                                                    $sa = App\Models\Todo_salle::where('todo_id', $t->id)->get();
                                                    $saa = $sa->pluck('salle_id');
                                                    $s = App\Models\Salle::whereIn('id', $saa)->first();
                                                @endphp

                                                <td>{{ $i }}</td>
                                                <td>{{ $t->date_debut }} --{{ $t->date_fin }}</td>
                                                <td>{{ $t->heure_debut }} - {{ $t->heure_fin }}</td>
                                                <td>{{ $t->name }} <br> </td>
                                                <td></td>

                                                @if($s)
                                                    <td>{{ $s->name }}</td>
                                                @else
                                                    <td>Salle non trouvée</td>
                                                @endif
                                            </tr>

                                            @php
                                                $i++;
                                            @endphp
                                        @endforeach
                                        </tbody>
                                    </table>
                                    {{-- <button id="saveButton" class="btn btn-primary mt-3">Enregistrer</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal"> Programmer une evaluation </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{ route('store_tache_eval', $id) }}">

                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Code de l'UE</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="title" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de debut</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de debut" id="heure_debut"
                                    name="heure_debut" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de fin</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de fin" name="heure_fin"
                                    id="heure_fin" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date de debut</label>
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Salle</label>
                            <div class="input-group">
                                <select class="form-control" name="salle" id="salle">
                                    <option value=""></option>
                                    @foreach ($salle as $sal)
                                        <option value="{{ $sal->id }}">{{ $sal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-0">

                            </div>
                            <button type="submit" name="submit" id="submit"
                                class="btn btn-primary m-t-15 waves-effect">Enregistrer
                            </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

{{-- <td style="display: flex"> --}}
{{-- <td> --}}



@push('script_other')
    <!-- Inclure les scripts JS de FullCalendar et ses dépendances -->
    <script src="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
    <!-- Inclure le script JS pour jsPDF -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> --}}
    {{-- <script src="{{ asset('assets/js/jspdf.umd.min.js') }}"></script> --}}
    <script src="{{ asset('js/html2pdf.bundle.min.js') }}"></script>

    <script>
        document.getElementById('generatePdf').addEventListener('click', function() {
            var element = document.getElementById(
                'tableExport'); // Remplacez 'contenu-a-imprimer' par l'ID de l'élément que vous souhaitez imprimer

            html2pdf(element);
        });

        // $('.fc-right').append(
        //     '<button class="btn btn-sm btn-primary" id="generatePdf"><i class="fas fa-print"></i> Imprimer</button>');
    </script>

    <!-- Ajoutez cette balise script à votre vue -->
    <script>
        // Fonction pour formater l'heure au format 24 heures
        function formatTime(timeString) {
            var timeArray = timeString.split(':');
            var hours = parseInt(timeArray[0], 10);
            var minutes = timeArray[1];
            var suffix = hours >= 12 ? 'PM' : 'AM';
            hours = hours % 12 || 12;
            return hours + ':' + minutes + ' ' + suffix;
        }

        // Écoutez le formulaire avant la soumission
        document.getElementById('submit').addEventListener('click', function(e) {
            // Récupérez les valeurs des champs heure_debut et heure_fin
            var heureDebut = document.getElementById('heure_debut').value;
            var heureFin = document.getElementById('heure_fin').value;

            // Formatez les heures au format 24 heures
            var heureDebutFormat = formatTime(heureDebut);
            var heureFinFormat = formatTime(heureFin);
            // e.preventDefault();


            // Mettez à jour les valeurs dans les champs
            // document.getElementById('heure_debut').value = heureDebutFormat;
            // document.getElementById('heure_fin').value = heureFinFormat;
        });
    </script>


    {{-- <script>

            // Ajouter le bouton d'impression
            $('.fc-right').append(
                '<button class="btn btn-sm btn-primary" id="printButton"><i class="fas fa-print"></i> Imprimer</button>');

            function printCalendar() {
                // Imprime la page actuelle
                window.print();
            }


            // Gérer le clic sur le bouton d'impression
            $('#printButton').on('click', function() {
                printCalendar();
            });
        </script> --}}
@endpush
