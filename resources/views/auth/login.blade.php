<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Gestion Carburant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1503376780353-7e6692767b70?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .card {
            animation: fadeInUp 1s ease;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/2920/2920244.png" alt="Fuel Icon" width="80">
            <h4 class="mt-2">Connexion</h4>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Se connecter</button>
            <div class="text-center mt-3">
                <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
            </div>
        </form>
    </div>
</body>

</html>
