<!DOCTYPE html>
<html lang="en">


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <link rel="stylesheet" href="assets/bundles/bootstrap-social/bootstrap-social.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
</head>

<body>
    <div class="loader"></div>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div
                        class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Enregistrez-vous</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="" class="needs-validation" novalidate enctype="multipart/form-data">
                                    @csrf
                                    @method('POST')

                                    <div class="form-group">
                                        <div class="mb-3">
                                            <label for="name" class="form-label">Nom</label>
                                            <input id="name" type="text" class="form-control" name="name" tabindex="1" required>
                                            <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                        </div>

                                        <div class="mb-3">
                                            <label for="prenom" class="form-label">Prénom</label>
                                            <input id="prenom" type="text" class="form-control" name="prenom" tabindex="2">
                                        </div>

                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email</label>
                                            <input id="email" type="email" class="form-control" name="email" tabindex="3" required autofocus value="{{ old('email') }}">
                                            <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                            @error('email')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="password" class="form-label">Mot de passe</label>
                                            <input id="password" type="password" class="form-control" name="password" tabindex="4" required>
                                            <div class="invalid-feedback">Veuillez remplir ce champ.</div>
                                            @error('password')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        <div class="mb-3">
                                            <label for="telephone" class="form-label">Téléphone</label>
                                            <input id="telephone" type="text" class="form-control" name="telephone" tabindex="5" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="role" class="form-label">Rôle</label>
                                            <input id="role" type="text" class="form-control" name="role" tabindex="6" required>
                                        </div>

                                        <div class="mb-3">
                                            <label for="departement" class="form-label">Département (Si oui, nom du département)</label>
                                            <input id="departement" type="text" class="form-control" name="departement" tabindex="7">
                                        </div>

                                        <div class="mb-3">
                                            <label for="image" class="form-label">Ajouter une photo</label>
                                            <input type="file" class="form-control" name="image">
                                        </div>

                                        <div class="mb-3">
                                            <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="8">S'inscrire</button>
                                        </div>
                                    </div>
                                </form>

                                <div class="text-center mt-4 mb-3">
                                </div>
                                <div class="row sm-gutters">

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/js/app.min.js') }}"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="{{ asset('assets/bundles/apexcharts/apexcharts.min.js') }}"></script>
    <!-- Page Specific JS File -->
    <script src="{{ asset('assets/js/page/index.js') }}"></script>
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <!-- Custom JS File -->
    <script src="{{ asset('assets/js/custom.js') }}"></script>
</body>


<!-- auth-login.html  21 Nov 2019 03:49:32 GMT -->

</html>
