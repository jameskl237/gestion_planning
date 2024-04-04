@extends('layouts.base')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="card author-box card-primary ">
                <div class="main-top m-5">
                    <section class="section">
                        <form action="{{ route('store_sub') }}" method="post">
                            @csrf
                            @method('POST')
                            <div class="section-body">
                                <div class="row">
                                    <div class="col-12 col-md-6 col-lg-6">
                                        <div class="card">
                                            <div class="card-header">

                                                <h4>Programmer </h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-group">
                                                    <label>Titre de la tache</label>
                                                    <input type="text" name="name" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Description</label>
                                                    <div class="input-group">
                                                        <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date de debut</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="date" name="date_debut"
                                                            class="form-control pwstrength" required
                                                            data-indicator="pwindicator">
                                                    </div>
                                                    <div id="pwindicator" class="pwindicator">
                                                        <div class="bar"></div>
                                                        <div class="label"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Date de fin</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-calendar"></i>
                                                            </div>
                                                        </div>
                                                        <input type="date" name="date_fin" class="form-control currency"
                                                            required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Heure de debut</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-times"></i>
                                                            </div>
                                                        </div>
                                                        <input type="time" name="heure_debut"
                                                            class="form-control currency" required>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label>Heure de fin</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <div class="input-group-text">
                                                                <i class="fas fa-times"></i>
                                                            </div>
                                                        </div>
                                                        <input type="time" name="heure_fin" class="form-control currency"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="d-inline">Liste du Personnel</h4>
                                                {{-- <div class="card-header-action">
                                                    <a href="#" class="btn btn-primary">View All</a>
                                                </div> --}}
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
                                                            } else {
                                                                $color = 'secondary';
                                                            }
                                                        @endphp
                                                        <li class="media">
                                                            <div class="custom-control custom-checkbox">
                                                                <input type="checkbox" name="sub[]"
                                                                    class="custom-control-input"
                                                                    id="cbx-{{ $key }}"
                                                                    value="{{ $personne->id }}">
                                                                <label class="custom-control-label"
                                                                    for="cbx-{{ $key }}"></label>
                                                            </div>
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
                                                                    {{-- <span class="text-primary">Now</span> --}}
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach


                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" name="submit"
                                class="btn btn-primary m-t-15 waves-effect mb-3 ml-3">Enregistrer</button>
                        </form>
                    </section>
                </div>
            </div>


            <div class="settingSidebar">
                <a href="javascript:void(0)" class="settingPanelToggle"> <i class="fa fa-spin fa-cog"></i>
                </a>
                <div class="settingSidebar-body ps-container ps-theme-default">
                    <div class=" fade show active">
                        <div class="setting-panel-header">Setting Panel
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Select Layout</h6>
                            <div class="selectgroup layout-color w-50">
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="1"
                                        class="selectgroup-input-radio select-layout" checked>
                                    <span class="selectgroup-button">Light</span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="value" value="2"
                                        class="selectgroup-input-radio select-layout">
                                    <span class="selectgroup-button">Dark</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Sidebar Color</h6>
                            <div class="selectgroup selectgroup-pills sidebar-color">
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="1"
                                        class="selectgroup-input select-sidebar">
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Light Sidebar"><i class="fas fa-sun"></i></span>
                                </label>
                                <label class="selectgroup-item">
                                    <input type="radio" name="icon-input" value="2"
                                        class="selectgroup-input select-sidebar" checked>
                                    <span class="selectgroup-button selectgroup-button-icon" data-toggle="tooltip"
                                        data-original-title="Dark Sidebar"><i class="fas fa-moon"></i></span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <h6 class="font-medium m-b-10">Color Theme</h6>
                            <div class="theme-setting-options">
                                <ul class="choose-theme list-unstyled mb-0">
                                    <li title="white" class="active">
                                        <div class="white"></div>
                                    </li>
                                    <li title="cyan">
                                        <div class="cyan"></div>
                                    </li>
                                    <li title="black">
                                        <div class="black"></div>
                                    </li>
                                    <li title="purple">
                                        <div class="purple"></div>
                                    </li>
                                    <li title="orange">
                                        <div class="orange"></div>
                                    </li>
                                    <li title="green">
                                        <div class="green"></div>
                                    </li>
                                    <li title="red">
                                        <div class="red"></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="mini_sidebar_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Mini Sidebar</span>
                                </label>
                            </div>
                        </div>
                        <div class="p-15 border-bottom">
                            <div class="theme-setting-options">
                                <label class="m-b-0">
                                    <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input"
                                        id="sticky_header_setting">
                                    <span class="custom-switch-indicator"></span>
                                    <span class="control-label p-l-10">Sticky Header</span>
                                </label>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 p-3 align-center rt-sidebar-last-ele">
                            <a href="#" class="btn btn-icon icon-left btn-primary btn-restore-theme">
                                <i class="fas fa-undo"></i> Restore Default
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
