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
                            {{-- @php
                                $planning = App\Models\Planning::find($id);
                            @endphp --}}

                            <h4>{{ $planning->name }}</h4>
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
                                                <tr>
                                                    @php
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
                                                    @switch($t->jour)
                                                        @case('Lundi')
                                                            <td class="" tabindex="5">{{ $t->heure_debut }} -
                                                                {{ $t->heure_fin }}

                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});" title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td><a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @break

                                                        @case('Mardi')
                                                            <td class="">
                                                                {{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td><a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif

                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @break

                                                        @case('Mercredi')
                                                            <td class="">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @break

                                                        @case('Jeudi')
                                                            <td class="">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        @break

                                                        @case('Vendredi')
                                                            <td class="">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                        @break

                                                        @case('Samedi')
                                                            <td class="">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle:
                                                                    @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td></td>
                                                        @break

                                                        @case('Dimanche')
                                                            <td class="">{{ $t->heure_debut }} - {{ $t->heure_fin }}
                                                                <div class="d-flex">
                                                                    <!-- Bouton pour appeler le modal de modification -->
                                                                    <a class="btn btn-primary btn-action mr-1"
                                                                        onclick="edit_tache({{ $t->id }});"
                                                                        title="Modifier">
                                                                        <i class="fas fa-pencil-alt"></i>
                                                                    </a>

                                                                    <!-- Bouton pour effectuer la suppression -->
                                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                                        onclick="delete_tache({{ $t->id }});">
                                                                        <i class="fas fa-trash"></i>
                                                                    </a>
                                                                </div>
                                                            </td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td>
                                                                <a class="btn" onclick="duplique_tache({{ $t->id }})">
                                                                    {{ $t->name }}
                                                                    <br>
                                                                    {{ $t->description }} <br>
                                                                    @if ($enseignant)
                                                                        {{ $enseignant->name }}
                                                                    @else
                                                                    @endif
                                                                    <br> salle: @if ($s)
                                                                        {{ $s->name }}
                                                                    @else
                                                                        Nom de la salle non disponible
                                                                    @endif
                                                                </a>
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



    <div class="modal fade" id="modifModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modifModalLabel">Modifier une tache</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="modifModalBody" method="post">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label>Titre de la tache</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="title" id="namemodif"
                                    name="namemodif" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <textarea name="descriptionmodif" id="descriptionmodif" cols="30" rows="10"
                                    class="form-control phone-number"></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de debut</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de debut"
                                    id="heure_debutmodif" name="heure_debutmodif" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de fin</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de fin"
                                    id="heure_finmodif" name="heure_finmodif" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Salle</label>
                            <div class="input-group">
                                <select class="form-control" name="sallemodif" id="sallemodif">
                                    <option></option>
                                    @foreach ($salle as $sal)
                                        <option value="{{ $sal->id }}">{{ $sal->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jour</label>
                            <select class="form-control" name="jourmodif" id="jourmodif">
                                <option value=""></option>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                                <option value="Dimanche">Dimanche</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <div class="form-group mb-0"></div>
                            <label>Enseignant</label>
                            <select class="form-control" name="submodif" id="submodif" multiple data-height="100%"
                                style="height: 100%;">
                                <option></option>
                                @foreach ($tab as $personne)
                                    <option value="{{ $personne->id }}">{{ $personne->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group mb-0"></div>
                        <button type="submit" name="submit" id="submit"
                            class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="dupliqueModal" tabindex="-1" role="dialog" aria-labelledby="pdfModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="dupliqueModalLabel">Dupliquer une tache</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="dupliqueModalBody" method="post">
                        @csrf
                        @method('POST')

                        <div class="form-group">
                            <label>Heure de debut</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de debut"
                                    id="heure_debutduplique" name="heure_debutduplique" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Heure de fin</label>
                            <div class="input-group">
                                <input type="time" class="form-control" placeholder="heure de fin"
                                    name="heure_finduplique" id="heure_finduplique" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Jour</label>
                            <select class="form-control" name="jourduplique" id="jourduplique">
                                <option value=""></option>
                                <option value="Lundi">Lundi</option>
                                <option value="Mardi">Mardi</option>
                                <option value="Mercredi">Mercredi</option>
                                <option value="Jeudi">Jeudi</option>
                                <option value="Vendredi">Vendredi</option>
                                <option value="Samedi">Samedi</option>
                                <option value="Dimanche">Dimanche</option>
                            </select>
                        </div>
                        <div class="form-group mb-0"></div>
                        <button type="submit" name="submit" id="submit"
                            class="btn btn-primary m-t-15 waves-effect">Dupliquer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <label>Salle</label>
                            <div class="input-group">
                                <select class="form-control" name="salle" id="salle">
                                    <option></option>
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

                            <div class="form-group">
                                <label>Enseignant</label>
                                <select class="form-control" name="sub">
                                    <option></option>
                                    @foreach ($tab as $personne)
                                        <option value="{{ $personne->id }}">{{ $personne->name }}</option>
                                    @endforeach
                                </select>
                            </div>

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





@push('script_other')
    <!-- Inclure les scripts JS de FullCalendar et ses dépendances -->
    <script src="{{ asset('assets/bundles/fullcalendar/fullcalendar.min.js') }}"></script>

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
        // import $ from 'jquery';

        function edit_tache(id) {
            var formUpdateTache = document.getElementById('modifModalBody');
            formUpdateTache.setAttribute('action', "/edit/" + id);
            var url = "/get/" + id;
            console.log(url);
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data === 'off') {
                        // Gérez le cas où les données ne sont pas disponibles
                    } else {
                        $('#namemodif').val(data.name);
                        $('#descriptionmodif').val(data.description);
                        $('#heure_debutmodif').val(data.heure_debut);
                        $('#heure_finmodif').val(data.heure_fin);
                        $('#sallemodif').val(data.salle);
                        $('#jourmodif').val(data.jour);
                        $('#submodif').val(data.sub);
                        console.log('Form data:', data.name); // Ajout de la vérification des données
                    }
                }
            });

            $('#modifModal').modal('show');
        }

        function duplique_tache(id) {
            var formUpdateTache = document.getElementById('dupliqueModalBody');
            formUpdateTache.setAttribute('action', "/duplique/" + id);
            var url = "/get/" + id;
            $.ajax({
                url: url,
                type: 'GET',
                success: function(data) {
                    console.log(data);
                    if (data === 'off') {
                        // Gérez le cas où les données ne sont pas disponibles
                    } else {
                        $('#heure_debutduplique').val(data.heure_debut);
                        $('#heure_finduplique').val(data.heure_fin);
                        $('#jourduplique').val(data.jour);
                        console.log('Form data:', data); // Ajout de la vérification des données
                    }
                }
            });

            $('#dupliqueModal').modal('show');
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
