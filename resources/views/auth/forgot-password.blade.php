<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mot de passe oublié</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to right, #ffecd2, #fcb69f);
        }

        .card {
            animation: fadeIn 1s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card shadow-lg p-4" style="max-width: 400px; width: 100%; border-radius: 1rem;">
        <div class="text-center mb-3">
            <img src="https://cdn-icons-png.flaticon.com/512/2910/2910768.png" alt="Forgot Password Icon"
                width="80">
            <h4 class="mt-2">Mot de passe oublié</h4>
        </div>
        <form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="mb-3">
                <label class="form-label">Adresse email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-info w-100">Recevoir un lien</button>
        </form>
    </div>
</body>

</html>
