<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vérification de l'email</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('https://images.unsplash.com/photo-1504384308090-c894fdcc538d?auto=format&fit=crop&w=1600&q=80') no-repeat center center fixed;
            background-size: cover;
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
    <div class="card shadow-lg p-4 text-center" style="max-width: 500px; width: 100%; border-radius: 1rem;">
        <img src="https://cdn-icons-png.flaticon.com/512/561/561127.png" alt="Email Verification Icon" width="80">
        <h4 class="mt-3">Vérifiez votre adresse email</h4>
        <p class="mt-2">Un email de vérification vous a été envoyé. Merci de consulter votre boîte de réception et de
            cliquer sur le lien de confirmation.</p>
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-success mt-2">Renvoyer l'email de vérification</button>
        </form>
        <div class="mt-3">
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Se déconnecter</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display:none;">@csrf</form>
        </div>
    </div>
</body>

</html>
