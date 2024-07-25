@extends($layouts)


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Listes des plannings</h4>
                            <button type="button" class="btn btn-icon icon-left btn-success" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fas fa-plus"></i>Nouveau planning
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($planning as $plan)
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon l-bg-red">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-right">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i><a
                                                                href="{{ route('affiche_eval', $plan->id) }}">{{ $plan->name }}</a>
                                                        </h3>
                                                        <span class="text-muted">{{ $plan->description }}</span>

                                                    </div>
                                                    <!-- Bouton pour effectuer la suppression -->
                                                    <a class="btn btn-danger btn-action" title="Supprimer"
                                                        onclick="delete_tache({{ $plan->id }});">
                                                        <i class="fas fa-trash"></i>
                                                    </a>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- modal d'ajout de planning --}}

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="formModal">creer un planning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="" method="POST" action="{{ route('store_eval') }}">
                        @csrf
                        @method('POST')
                        <div class="form-group">
                            <label>nom du planning</label>
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="nom" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <div class="input-group">
                                <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="form-group mb-0">

                            </div>
                            <button type="submit" name="submit" id="submit"
                                class="btn btn-primary m-t-15 waves-effect">Enregistrer
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script_other')
    <script>
        function delete_tache(id) {
            swal({
                title: 'Suppression',
                text: 'Voulez-vous vraiment supprimer ??',
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    var url = "/destroy_planning/" + id;
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
