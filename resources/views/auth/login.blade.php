<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
        body {
            background-color: #f3f4f6;
            font-family: Arial, sans-serif;
        }
        .container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-box {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        .title {
            text-align: center;
            font-size: 1.875rem;
            font-weight: bold;
            margin-bottom: 2rem;
        }
        .form-group {
            margin-bottom: 1rem;
        }
        input {
            width: 100%;
            padding: 0.5rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            margin-bottom: 1rem;
        }
        .btn {
            width: 100%;
            padding: 0.5rem;
            background-color: #4f46e5;
            color: white;
            border: none;
            border-radius: 0.375rem;
            cursor: pointer;
        }
        .btn:hover {
            background-color: #4338ca;
        }
        .error {
            color: #ef4444;
            font-size: 0.875rem;
            margin-bottom: 1rem;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-box">
            <h2 class="title">Connexion</h2>
            <form action="{{ route('login') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="email" name="email" type="email" required placeholder="Adresse email">
                </div>
                <div class="form-group">
                    <input id="password" name="password" type="password" required placeholder="Mot de passe">
                </div>

                @if ($errors->any())
                    <div class="error">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <button type="submit" class="btn">Se connecter</button>
            </form>
            <div class="login-link">
                <p>vous n´avez pas de compte? <a href="{{ route('register') }}">S´inscrire</a></p>
            </div>
        </div>
    </div>
</body>
</html> 