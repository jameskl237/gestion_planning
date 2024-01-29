@extends('layouts.base')

@section('search_bar')
    {{-- <form class="form-inline mr-auto">
        <div class="search-element">
            <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="200">
            <button class="btn" type="submit">
                <i class="fas fa-search"></i>
            </button>
        </div>
    </form> --}}
@endsection


@section('content')
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
                                                    style="width: 89px;">Titre
                                                    de la tache</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Position: activate to sort column ascending"
                                                    style="width: 140px;">Description</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Office: activate to sort column ascending"
                                                    style="width: 61px;">Heure de debut</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Age: activate to sort column ascending"
                                                    style="width: 25px;">Heure de fin</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Start date: activate to sort column ascending"
                                                    style="width: 60px;">Date de debut</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 51px;">Date de fin</th>
                                                <th class="sorting" tabindex="0" aria-controls="tableExport"
                                                    rowspan="1" colspan="1"
                                                    aria-label="Salary: activate to sort column ascending"
                                                    style="width: 51px;">Action</th>


                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($arr as $val)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1"><a href="{{ route('calendar') }}">{{ $val->name }}</a></td>
                                                    <td>{{ $val->description }}</td>
                                                    <td>{{ $val->heure_debut }}</td>
                                                    <td>{{ $val->heure_fin }}</td>
                                                    <td>{{ $val->date_debut }}</td>
                                                    <td>{{ $val->date_fin }}</td>
                                                    {{-- <td style="display: flex"> --}}
                                                    <td>
                                                        <!-- Bouton pour appeler le modal de modification -->
                                                        <a class="btn btn-primary btn-action mr-1"
                                                            onclick="edit_tache({{ $val->id }});" title="Modifier">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>

                                                        <!-- Bouton pour effectuer la suppression -->
                                                        <a class="btn btn-danger btn-action" title="Supprimer"
                                                            onclick="delete_tache({{ $val->id }});">
                                                            <i class="fas fa-trash"></i>
                                                        </a>

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

    <!-- Modal d'ajout -->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">Ajouter une tache </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{ route('todo.store') }}">
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
                            <label>Date de debut</label>
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Date de fin</label>
                            <div class="input-group">
                                <input type="date" class="form-control" placeholder="date de fin" name="date_fin">
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
            @foreach ($arr as $val )

            <div class="modal-body" id="modifModalBody">
                <form action="{{ route('tache_update', $val->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Titre de la tache</label>
                        <input type="text" class="form-control" value="{{ $val->name }}" name="name"
                            id="name" required>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <div class="input-group">
                            <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number">{{ $val->description }}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="heure_debut">Heure de début</label>
                        <input type="time" class="form-control" placeholder="heure de debut" name="heure_debut"
                            id="heure_debut" value="{{ $val->heure_debut }}" required>
                    </div>
                    <div class="form-group">
                        <label for="heure_fin">Heure de fin</label>
                        <input type="time" class="form-control" placeholder="heure de fin" name="heure_fin"
                            id="heure_fin" value="{{ $val->heure_fin }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date_debut">Date de début</label>
                        <input type="date" class="form-control" placeholder="date de debut" name="date_debut"
                            id="date_debut" value="{{ $val->date_debut }}" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin">Date de fin</label>
                        <input type="date" class="form-control" value="{{ $val->date_fin }}" placeholder="date de fin" name="date_fin"
                            id="date_fin">
                    </div>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                </form>
            </div>
            @endforeach
        </div>
    </div>
</div>


@push('script_other')
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
