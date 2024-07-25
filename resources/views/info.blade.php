@extends($layouts)


@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card author-box card-primary ">
                <div class="main-top m-5">
                    <section class="section">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="d-inline">Liste du Personnel</h4>

                                </div>
                                <div class="card-body">
                                    <ul class="list-unstyled list-unstyled-border">


                                        @foreach ($tab as $key => $personne)
                                            @php
                                                $role = App\Models\Role::where('id', $personne->role_id)->first();

                                                if ($role->rang == 1) {
                                                    $color = 'danger';
                                                } elseif ($role->rang == 2) {
                                                    $color = 'primary';
                                                } elseif ($role->rang == 3) {
                                                    $color = 'warning';
                                                } elseif ($role->rang == 4) {
                                                    $color = 'success';
                                                }elseif ($role->rang == 5) {
                                                    $color = 'yellow';
                                                } else {
                                                    $color = 'secondary';
                                                }
                                            @endphp
                                            <li class="media">
                                                <img alt="image" class="mr-3 rounded-circle" width="50"
                                                    src="images/{{ $personne->image }}">
                                                <div class="media-body">
                                                    <div
                                                        class="badge badge-pill badge-{{ $color }} mb-1 float-right">
                                                        {{ $role->nom }}</div>
                                                    <h6 class="media-title"><a href="#">Mr
                                                            {{ $personne->name }}</a>
                                                    </h6>
                                                    <div class="text-small text-muted">{{ $role->libelle }}
                                                        <div class="bullet"></div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach


                                    </ul>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>
@endsection
