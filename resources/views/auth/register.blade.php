<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
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
        .register-box {
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
        .login-link {
            text-align: center;
            margin-top: 1rem;
        }
        .login-link a {
            color: #4f46e5;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="register-box">
            <h2 class="title">Inscription</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input id="name" name="name" type="text" required 
                        placeholder="Nom complet" value="{{ old('name') }}">
                </div>
                <div class="form-group">
                    <input id="email" name="email" type="email" required 
                        placeholder="Adresse email" value="{{ old('email') }}">
                </div>

                <div class="mb-3">
                <label for="role_id" class="form-label">{{ __('Role') }}</label>
                <select name="role_id" id="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                    <option value="">{{ __('Select a role') }}</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->id }}" {{ old('role_id') == $role->id ? 'selected' : '' }}>
                            {{ $role->titre }}
                        </option>
                    @endforeach
                </select>
                @error('role_id')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                </div>
                <div class="form-group">
                    <input id="password" name="password" type="password" required 
                        placeholder="Mot de passe">
                </div>
                <div class="form-group">
                    <input id="password_confirmation" name="password_confirmation" 
                        type="password" required placeholder="Confirmer le mot de passe">
                </div>

                @if ($errors->any())
                    <div class="error">
                        @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                        @endforeach
                    </div>
                @endif

                <button type="submit" class="btn">S'inscrire</button>
            </form>
            <div class="login-link">
                <p>Déjà inscrit ? <a href="{{ route('login') }}">Se connecter</a></p>
            </div>
        </div>
    </div>
</body>
</html> 