<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow" style="width: 500px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Inscription</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Entrez votre nom" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Entrez votre email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="mb-3">
                    <label for="password_confirmation" class="form-label">Confirmez le mot de passe</label>
                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmez votre mot de passe" required>
                </div>
                <div class="d-grid">
                    <button type="submit" class="btn btn-success">S'inscrire</button>
                </div>
            </form>
            <p class="text-center mt-3">
                Déjà inscrit ? <a href="{{ route('login') }}">Connectez-vous</a>
            </p>
        </div>
    </div>
</body>
</html>
