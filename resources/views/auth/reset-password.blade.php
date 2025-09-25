<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réinitialisation du mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1504215680853-026ed2a45def?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
        }

        .card {
            animation: zoomIn 0.8s ease;
        }

        @keyframes zoomIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 450px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3064/3064197.png" alt="Password Reset Icon" width="80">
            <h4 class="mt-2">Réinitialiser le mot de passe</h4>
        </div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Votre email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning w-100">Envoyer le lien de réinitialisation</button>
            <div class="text-center mt-3">
                <a href="{{ route('login') }}">Retour à la connexion</a>
            </div>
        </form>
    </div>
</body>

</html>
