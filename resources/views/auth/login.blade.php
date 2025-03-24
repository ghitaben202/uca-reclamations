<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Se connecter</title>
    
    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

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
    </style>
</head>
<body>
    <div class="container container-custom">
        <div class="row w-100 d-flex justify-content-center align-items-center">
            <!-- Image et Titre -->
            <div class="col-md-6 ">
                <div class="card card-custom1 shadow w-100">
                    <img src="{{asset('images/logo.jpeg')}}" alt="Register" class="img-fluid mb-3 d-block mx-auto" style="max-height: 150px;border: 3px solid  rgba(172, 94, 5, 0.8); border-radius: 0px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);">
                    <h5>Vous avez un compte ?</h5>
                    <h4 class="fw-bold">Se connecter</h4>
                    <span style="font-weight: bold; font-size: 23px;font-family:calibri">→</span>
                </div>
            </div>
            <div class="col-md-6 ">
                <div class="card card-custom shadow w-100">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="email_personnel" class="form-label">{{ __('Email') }}</label>
                            <input type="email" name="email_personnel" id="email_personnel" class="form-control" value="{{ old('email_personnel') }}" required autofocus>
                            @error('email_personnel')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="mot_de_passe" class="form-label">{{ __('Mot de passe') }}</label>
                            <input type="password" name="mot_de_passe" id="mot_de_passe" class="form-control " required autocomplete="current-password">
                            @error('mot_de_passe')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-custom w-100">{{ __('Se connecter') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <footer class="text-center p-3">
        © Copyright 2025 <strong>UCA</strong>. Tous droits réservés.
</footer>
</body>
</html>
