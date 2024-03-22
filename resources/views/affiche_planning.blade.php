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
                                            @foreach ($task as $t)
                                                {{-- @foreach ($sal as $s) --}}
                                                <tr>
                                                    @php
                                                        $sa = App\Models\Todo_salle::where('todo_id', $t->id)->get();
                                                        $saa = $sa->pluck('salle_id');
                                                        $s = App\Models\Salle::whereIn('id', $saa)->first();
                                                    @endphp
                                                    @switch($t->jour)
                                                        @case('Lundi')
                                                            <td class="d-flex align-items" tabindex="5">{{ $t->heure_debut }} -
                                                                {{ $t->heure_fin }}

                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }} <br>
                                                                salle: {{ $s->name }}

                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Mardi')
                                                        <td class="d-flex align-items" tabindex="6">
                                                            {{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                            <div class="d-flex">
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);" title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer" onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </div>
                                                        </td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6">{{ $t->name }} <br> {{ $t->description }}
                                                                <br>
                                                                salle: {{ $s->name }}
                                                            </td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                            <td tabindex="6"></td>
                                                        @break

                                                        @case('Mercredi')
                                                            <td class="d-flex align-items">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Jeudi')
                                                            <td class="d-flex align-items">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Vendredi')
                                                            <td class="d-flex align-items">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Samedi')
                                                            <td class="d-flex align-items">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}
                                                            </td>
                                                            <td tabindex="5"></td>
                                                        @break

                                                        @case('Dimanche')
                                                            <td class="d-flex align-items">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <!-- Bouton pour appeler le modal de modification -->
                                                                <a class="btn btn-primary btn-action mr-1" onclick="edit_tache($t-id);"
                                                                    title="Modifier">
                                                                    <i class="fas fa-pencil-alt"></i>
                                                                </a>

                                                                <!-- Bouton pour effectuer la suppression -->
                                                                <a class="btn btn-danger btn-action" title="Supprimer"
                                                                    onclick="delete_tache($t-id);">
                                                                    <i class="fas fa-trash"></i>
                                                                </a>
                                                            </td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5"></td>
                                                            <td tabindex="5">{{ $t->name }} <br> {{ $t->description }}
                                                                <br> salle: {{ $s->name }}
                                                            </td>
                                                        @break

                                                        @default
                                                    @endswitch
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <button id="saveButton" class="btn btn-primary mt-3">Enregistrer</button>
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


<div class="modal" id="modifModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modifModalLabel">Modifier une tache</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            @foreach ($task as $t )

            <div class="modal-body" id="modifModalBody">
                <form action="{{ route('tache_update', $t->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Titre de la tache</label>
                        <input type="text" class="form-control" value="{{ $t->name }}" name="name"
                            id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input-group">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number">{{ $t->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="heure_debut">Heure de début</label>
                        <input type="time" class="form-control" placeholder="heure de debut" name="heure_debut"
                            id="heure_debut" value="{{ $t->heure_debut }}" required>
                    </div>
                    <div class="form-group">
                        <label for="heure_fin">Heure de fin</label>
                        <input type="time" class="form-control" placeholder="heure de fin" name="heure_fin"
                            id="heure_fin" value="{{ $t->heure_fin }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date_debut">Date de début</label>
                        <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                            id="date_debut" value="{{ $t->date_debut }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" class="form-control" value="{{ $t->date_fin }}" placeholder="date de fin" name="date_fin"
                            id="date_fin">
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- <td style="display: flex"> --}}
{{-- <td> --}}



@push('script_other')
    <!-- Inclure les scripts JS de FullCalendar et ses dépendances -->
    <script src="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>
    <script>
        document.getElementById('generatePdf').addEventListener('click', function() {
            var element = document.getElementById(
                'tableExport'); // Remplacez 'contenu-a-imprimer' par l'ID de l'élément que vous souhaitez imprimer

            html2pdf(element);
        });

        // $('.fc-right').append(
        //     '<button class="btn btn-sm btn-primary" id="generatePdf"><i class="fas fa-print"></i> Imprimer</button>');
    </script>

    <!-- Ajoutez cette balis;:e script à votre vue -->
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


    </script>

<script type="text/javascript">
    function edit_tache(id) {
        var formUpdateTache = document.getElementById('modifModalBody');
        formUpdateTache.setAttribute('action', "/tache_update/" + id);
        var url = "/tache_update/" + id;
        $.ajax({
            url: url,
            type: 'GET',
            success: function(data) {
                console.log(data);
                if (data === 'off') {
                    // Gérez le cas où les données ne sont pas disponibles
                } else {
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#heure_debut').val(data.heure_debut);
                    $('#heure_fin').val(data.heure_fin);
                    $('#date_debut').val(data.date_debut);
                    $('#date_fin').val(data.date_fin);
                    console.log('Form data:', data); // Ajout de la vérification des données
                }
            }
        });

        $('#modifModal').modal('show');
    }

    function delete_tache(id) {
        swal({
            title: 'Suppression',
            text: 'Voulez-vous vraiment supprimer ??',
            icon: 'warning',
            buttons: true,
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                var url = "/destroy/" + id;
                var xhr = new XMLHttpRequest();
                xhr.open('DELETE', url);
                xhr.setRequestHeader('X-CSRF-TOKEN', '{{ csrf_token() }}');
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        console.log(response);
                        if (response === 'ok') {
                            swal('Suppression réussie avec succès !!', {
                                icon: 'success',
                            });
                            location.reload();
                        } else {
                            swal('Une erreur est survenue  !!', {
                                icon: 'error',
                            });
                        }
                    } else {
                        swal('Une erreur est survenue  !!', {
                            icon: 'error',
                        });
                    }
                };
                xhr.send();
            }
        });
    }
</script>
@endpush
