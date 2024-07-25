@extends($layouts)


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Listes des plannings</h4>
                            {{-- <button type="button" class="btn btn-icon icon-left btn-success" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="fas fa-plus"></i>Nouveau planning
                            </button> --}}
                        </div>
                        <div class="card-body">
                            <div class="row">
                                {{-- @foreach ($planning as $plan) --}}
                                    <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                                        <div class="card card-statistic-1">
                                            <div class="card-icon l-bg-red">
                                                <i class="fas fa-calendar"></i>
                                            </div>
                                            <div class="card-wrap">
                                                <div class="padding-20">
                                                    <div class="text-right">
                                                        <h3 class="font-light mb-0">
                                                            <i class="ti-arrow-up text-success"></i>
                                                            <a href="{{ route('affiche_personnel') }}">Personnel</a>
                                                        </h3>
                                                        <span class="text-muted"></span>


                                                    </div>
                                                     <!-- Bouton pour effectuer la suppression -->
                                                        {{-- <a class="btn btn-danger btn-action" title="Supprimer"
                                                            onclick="delete_tache({{ $plan->id }});">
                                                            <i class="fas fa-trash"></i>
                                                        </a> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection