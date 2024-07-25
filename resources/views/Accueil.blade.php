<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page de Garde - Gestion de Planning</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container-fluid h-100 d-flex align-items-center justify-content-center">
        <div class="jumbotron text-center">
            <h1 class="display-4">Bienvenue à la Gestion de Planning</h1>
            <p class="lead">Gérez facilement votre planning et vos tâches avec notre application.</p>
            <hr class="my-4">
            <p>Commencez dès maintenant en vous connectant à votre compte.</p>
            <a class="btn btn-primary btn-lg" href="{{ route('auth.login') }}" role="button">Se connecter</a>
        </div>
    </div>

    <footer class="footer mt-5 py-3 bg-light text-center">
        <div class="container">
            <span class="text-muted">&copy; 2024 Université de Yaoundé I. Tous droits réservés.</span>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
