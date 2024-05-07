<!DOCTYPE html>
<html lang="en">


<!-- navbar.html  21 Nov 2019 03:51:03 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Planning_UYI</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/css/app.min.css') }}">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/bundles/prism/prism.css') }}">

    <!-- Custom style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    <link rel='shortcut icon' type='image/x-icon' href='{{ asset('assets/img/favicon.ico') }}' />

    @yield('style')
</head>


<body>
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>ajouts</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('add_dep') }}" method="post" id="">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Departement</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">nom</label>
                                        <input type="text" class="form-control" name="namedep" id="name"
                                            required>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                                    <div class="form-group"></div>
                                </form>

                                <form action="{{ route('add_role') }}" method="post" id="">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Role</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">nom</label>
                                        <input type="text" class="form-control" name="namerole" id="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Libelle</label>
                                        <input type="text" class="form-control" name="libelle" id="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Rang</label>
                                        <input type="text" class="form-control" name="rang" id="name"
                                            required>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                                    <div class="form-group"></div>
                                </form>

                                <form action="{{ route('add_sal') }}" method="post" id="">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Salle</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">nom</label>
                                        <input type="text" class="form-control" name="namesal" id="name"
                                            required>
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                                    <div class="form-group"></div>
                                </form>


                                {{-- <form action="{{ route('add_user') }}" method="post" id="">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="name">Utilisateur</label>
                                    </div>

                                    <div class="form-group">
                                        <label for="name">nom</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            required>
                                    </div>
                                    <div class="form-group">
                                        <label>prenom</label>
                                        <div class="input-group">
                                            <textarea name="description" id="" cols="30" rows="10" class="form-control phone-number"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">email</label>
                                        <input type="email" class="form-control" placeholder="email" name="email"
                                            id="email" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="heure_fin">password</label>
                                        <input type="password" class="form-control" placeholder="password"
                                            name="password" id="password" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_debut">image</label>
                                        <input type="date" class="form-control" placeholder="date de debut"
                                            name="date_debut" id="date_debut" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="date_fin">telephone</label>
                                        <input type="date" class="form-control" placeholder="date de fin"
                                            name="date_fin" id="date_fin">
                                    </div>
                                    <div class="form-group">
                                        <label for="date_fin">role</label>
                                        <input type="date" class="form-control" placeholder="date de fin"
                                            name="date_fin" id="date_fin">
                                    </div>

                                    <div class="form-group">
                                        <label for="date_fin">departement</label>
                                        <input type="date" class="form-control" placeholder="date de fin"
                                            name="date_fin" id="date_fin">
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary m-t-15 waves-effect">Enregistrer</button>
                                    <div class="form-group"></div>
                                </form> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>
