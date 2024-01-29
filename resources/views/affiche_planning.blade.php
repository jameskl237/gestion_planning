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
    {{-- <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Planning</h4>
                        </div>
                        <div class="card-body">
                            <div class="fc-overflow">
                                <div id="myEvent"></div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Listes des taches</h4>
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
                                                    style="width: 89px;">Heure</th>
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
                                            {{-- <tr>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                                <td tabindex="1"><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                                <td tabindex="2"><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                                <td tabindex="3"><input type="text" class="form-control"></td>
                                            </tr>
                                            <tr>
                                                <td tabindex="4"><input type="text" style="height: 100px" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td>
                                                <td tabindex="4"><input type="text" class="form-control"></td> --}}
                                            </tr>

                                            @foreach ($task as $t)
                                                {{-- @foreach ($sal as $s) --}}
                                                <tr>
                                                    @php
                                                        $sa = App\Models\Todo_salle::where('todo_id', $t->id)->get();
                                                        $saa = $sa->pluck('salle_id');
                                                        $s = App\Models\Salle::where('id', $saa)->first();
                                                    @endphp
                                                    @switch($t->jour)
                                                        @case('Lundi')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }} <br>
                                                                salle: {{ $s->name }}</td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Mardi')
                                                            <td tabindex="6">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6">{{ $t->name }} <br> {{ $t->description }} <br>
                                                                salle: {{ $s->name }}</td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                        @break

                                                        @case('Mercredi')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}</td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Jeudi')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}</td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Vendredi')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}</td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Samedi')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}</td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Dimanche')
                                                            <td tabindex="5">{{ $t->heure_debut }} - {{ $t->heure_debut }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}</td>
                                                        @break

                                                        @default
                                                    @endswitch
                                                    {{-- <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td>
                                                    <td tabindex="5"></td> --}}
                                                </tr>
                                                {{-- @endforeach --}}
                                            @endforeach

                                        </tbody>
                                    </table>
                                    <button id="saveButton" class="btn btn-primary mt-3">Enregistrer</button>
                                    {{-- <input --}}
                                    {{-- style="position: absolute; top: 309px; left: 25.0154px; padding: 0px 10px; text-align: left; font: 400 14px / 21px Nunito, &quot;Segoe UI&quot;, arial; border: 0px none rgb(33, 37, 41); width: 275.641px; height: 60px; display: none;"> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Ajouter une tache </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{ route('ajout', $id) }}">

                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>Titre de la tache</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="title" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de debut</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de debut"
                                    name="heure_debut" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de fin</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de fin" name="heure_fin"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date</label>
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
                            <label>Jour</label>
                            {{-- <div class="input-group">
                                <input type="date" class="form-control" placeholder="jour" name="jour">
                            </div> --}}
                            <select class="form-control" name="jour" id="jour">
                                <option value=""></option>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                                <option value="Dimanche">Dimanche</option>
                            </select>
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

{{-- @foreach ($arr as $val)
<tr role="row" class="odd">
    <td class="sorting_1"><a href="{{ route('calendar') }}">{{ $val->name }}</a></td>
    <td>{{ $val->description }}</td>
    <td>{{ $val->heure_debut }}</td>
    <td>{{ $val->heure_fin }}</td>
    <td>{{ $val->date_debut }}</td>
    <td>{{ $val->date_fin }}</td>
    {{-- <td style="display: flex"> --}}
{{-- <td> --}}
<!-- Bouton pour appeler le modal de modification -->
{{-- <a class="btn btn-primary btn-action mr-1"
            onclick="edit_tache({{ $val->id }});" title="Modifier">
            <i class="fas fa-pencil-alt"></i>
        </a> --}}

<!-- Bouton pour effectuer la suppression -->
{{-- <a class="btn btn-danger btn-action" title="Supprimer"
            onclick="delete_tache({{ $val->id }});">
            <i class="fas fa-trash"></i>
        </a> --}}

{{-- </tr>
@endforeach  --}}

@push('script_other')
    <!-- Inclure les scripts JS de FullCalendar et ses dépendances -->
    <script src="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
    <!-- Inclure le script JS pour jsPDF -->
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script> --}}
    <script src="{{ asset('assets/js/jspdf.umd.min.js') }}"></script>

    <script>
        var calendar = $('#myEvent').fullCalendar({
            height: 'auto',
            defaultView: 'month',
            editable: true,
            selectable: true,
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay,listMonth'
            },
            dayNamesShort: moment.weekdaysShort(true), // Utilisez les noms des jours abrégés
            monthNames: moment.months(true), // Utilisez les noms des mois
            // locale: '{{ app()->getLocale() }}',

            events: [

            ],
            eventClick: function(event) {
                if (event.url) {
                    window.open(event.url);
                    return false;
                }
            },
        });

        // Ajouter le bouton d'impression
        $('.fc-right').append(
            '<button class="btn btn-sm btn-primary" id="printButton"><i class="fas fa-print"></i> Imprimer</button>');

        function printCalendar() {
            // Imprime la page actuelle
            window.print();
        }
        //     document.getElementById('printButton').addEventListener('click', function () {
        //        window.location.href = '/generate-pdf'; // Rediriger vers la route pour générer le PDF
        //    });

        // function printCalendar() {
        //     // Créer une instance de jsPDF
        //     var doc = new jsPDF();

        //     // Obtenir le contenu HTML du calendrier
        //     var calendarContent = document.getElementById('myEvent').innerHTML;

        //     // Ajouter le contenu HTML au PDF
        //     doc.fromHTML(calendarContent, 15, 15);

        //     // Imprimer le PDF
        //     doc.autoPrint();

        //     // Enregistrer le PDF
        //     doc.save('calendrier.pdf');
        // }


        // Gérer le clic sur le bouton d'impression
        $('#printButton').on('click', function() {
            printCalendar();
        });
    </script>
    <script>
        $(document).ready(function() {
            // Initialize DataTable
            const table = $('#tableExport').DataTable();

            // Add a new row
            $('#addRowButton').on('click', function() {
                table.row.add(['', '']).draw();
            });

            // Save table data
            $('#saveButton').on('click', function() {
                const data = table.rows().data().toArray();

                // You can now send the 'data' array to your Laravel backend for processing
                console.log(data);
                // Example: You can use AJAX to send data to the server
                // $.ajax({
                //     type: 'POST',
                //     url: '/save-table',
                //     data: {tableData: data},
                //     success: function (response) {
                //         console.log(response);
                //     }
                // });
            });
        });
    </script>
@endpush
