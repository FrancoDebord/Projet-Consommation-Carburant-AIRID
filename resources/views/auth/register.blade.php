<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - Gestion Carburant</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #d4fc79, #96e6a1);
        }

        .card {
            animation: bounceIn 1s ease;
        }

        @keyframes bounceIn {
            0% {
                transform: scale(0.8);
                opacity: 0;
            }

            60% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 500px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" alt="Register Icon" width="80">
            <h4 class="mt-2">Créer un compte</h4>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nom complet</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success w-100">S'inscrire</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Déjà un compte ? Connectez-vous</a>
            </div>
        </form>
    </div>
</body>

</html>
