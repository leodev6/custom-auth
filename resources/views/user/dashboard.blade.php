<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Utilisateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-success bg-success">
        <div class="container-fluid">
            <a class="navbar-brand text-white" href="#">Utilisateur</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="btn btn-outline-light" href="{{ route('logout') }}">Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container text-center mt-5">
        <h1 class="display-4">Bienvenue, Utilisateur</h1>
        <p class="lead">Vous êtes connecté en tant qu'utilisateur standard.</p>
        <a href="#" class="btn btn-primary mt-3">Voir votre profil</a>
    </div>
</body>
</html>
