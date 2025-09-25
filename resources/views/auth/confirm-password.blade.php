<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation du mot de passe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #a1c4fd, #c2e9fb);
        }

        .card {
            animation: slideIn 0.8s ease;
        }

        @keyframes slideIn {
            from {
                transform: translateX(-50px);
                opacity: 0;
            }

            to {
                transform: translateX(0);
                opacity: 1;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/3064/3064155.png" alt="Confirm Password Icon"
                width="80">
            <h4 class="mt-2">Confirmez votre mot de passe</h4>
        </div>
        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Mot de passe</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Confirmer</button>
        </form>
    </div>
</body>

</html>
