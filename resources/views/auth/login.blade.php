<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    
    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&family=Almarai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: rgba(229, 221, 208, 0.5);
            font-family: 'Open Sans', sans-serif;
        }

        .container-custom {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .card-custom1 {
            padding: 13px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            background :  rgba(255, 255, 255, 0.6);
            text-align: center;

        }
        .card-custom {
            padding: 50px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            background :  rgba(255, 255, 255, 0.6);
            text-align: center;

        }

        .btn-custom {
            background-color: rgb(172, 94, 5);
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color:rgb(142, 79, 12);
        }

        .form-control {
            background: rgba(255, 255, 255, 0.8);
            border: 1px solid #ccc;
        }

        .image-box {
            background: white;
            padding: 20px;
            border-radius: 10px;
        }

        .password-container {
            position: relative;
            max-width: 350px;
            margin: 2rem auto;

        }
        .password-container input {
            padding-right: 2.5rem;
        }

        .password-container i {
            position: absolute;
            top: 75%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color:rgb(21, 22, 23);

        }
    </style>
</head>
<body>
    <div class="container container-custom">
        <div class="row w-100 d-flex justify-content-center align-items-center">
            <div class="col-12 mb-4">
                <a href="/" class="btn btn-custom">
                    <i class="fi fi-rr-arrow-left"></i> Retour à l'accueil
                </a>
            </div>
            <!-- Image et Titre -->
            <div class="col-md-6 ">
                <div class="card card-custom1 shadow w-100">
                    <img src="{{asset('images/logo.jpeg')}}" alt="Register" class="img-fluid mb-3 d-block mx-auto" style="max-height: 150px;border: 3px solid  rgba(172, 94, 5, 0.8); border-radius: 0px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);">
                    <h5>Vous avez un compte ?</h5>
                    <h4 class="fw-bold">Se connecter</h4>
                    <i class="fi fi-rr-arrow-right fs-3"></i>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="card card-custom shadow w-100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif

                        <div class="mb-3">

                            <label for="email" class="form-label">Email (personnel ou académique)</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" required autofocus>
                            @error('email')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror

                        </div>
                        <div class="mb-3" >
                            <label for="mot_de_passe" class="form-label">Mot de passe</label>

                            <div class="password-container">
                                <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control @error('mot_de_passe') is-invalid @enderror" required autocomplete="current-password">
                                <i class="fi fi-rr-eye" id="togglePassword"></i>
                            </div>
                            @error('mot_de_passe')
                                <div class="text-danger mt-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 text-end">
                            <a href="#" class="text-decoration-none" style="color: rgb(172, 94, 5);">Mot de passe oublié ?</a>
                        </div>
                        <button type="submit" class="btn btn-custom w-100">Se connecter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center p-3">
        © Copyright 2025 <strong>UCA</strong>. Tous droits réservés.
    </footer>
    <script>
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('mot_de_passe');
            const icon = this;
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fi-rr-eye');
                icon.classList.add('fi-rr-eye-crossed');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fi-rr-eye-crossed');
                icon.classList.add('fi-rr-eye');
            }
        });
    </script>
</body>
</html>
