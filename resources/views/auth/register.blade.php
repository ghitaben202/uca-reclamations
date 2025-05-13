<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    
    <!-- Bootstrap & Google Fonts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@400;700&family=Almarai:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@flaticon/flaticon-uicons/css/all/all.css" rel="stylesheet">
    <style>
        body {
            background: rgba(229, 221, 208, 0.5);
            font-family: 'Ubuntu', sans-serif;
        }

        .container-custom {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-custom {
            padding: 30px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
            background :  rgba(255, 255, 255, 0.8);
            text-align: center;

        }

        .btn-custom {
            background-color: #F4A900;
            color: white;
            font-weight: bold;
            transition: all 0.3s;
        }

        .btn-custom:hover {
            background-color: #D48A00;
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
                <div class="card card-custom shadow w-100" style="background-color: rgba(255, 255, 255, 0.6);">
                    <img src="{{asset('images/logo.jpeg')}}" alt="Register" class="img-fluid mb-3 d-block mx-auto" style="max-height: 150px; border: 3px solid  rgba(172, 94, 5, 0.8); border-radius: 0px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);">
                    <h5>Vous n'avez pas d'email académique ?</h5>
                    <h3 class="fw-bold">Créer un compte </h3>
                    <i class="fi fi-rr-arrow-right fs-3"></i>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="col-md-6 ">
                <div class="card card-custom shadow w-100" style="background-color: rgba(255, 255, 255, 0.6);">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3 text-start">
                            <label for="nom" class="form-label fs-5">Nom</label>
                            <input id="nom" type="text" class="form-control @error('nom') is-invalid @enderror" name="nom" value="{{ old('nom') }}" required autofocus>
                            @error('nom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="prenom" class="form-label fs-5">Prénom</label>
                            <input id="prenom" type="text" class="form-control @error('prenom') is-invalid @enderror" name="prenom" value="{{ old('prenom') }}" required>
                            @error('prenom')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="email_personnel" class="form-label fs-5">Email personnel</label>
                            <input id="email_personnel" type="email" class="form-control @error('email_personnel') is-invalid @enderror" name="email_personnel" value="{{ old('email_personnel') }}" required>
                            @error('email_personnel')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="mot_de_passe" class="form-label fs-5">Mot de passe</label>
                            <input id="mot_de_passe" type="password" class="form-control @error('mot_de_passe') is-invalid @enderror" name="mot_de_passe" required>
                            @error('mot_de_passe')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 text-start">
                            <label for="role_id" class="form-label fs-5">Rôle</label>
                            <select id="role_id" name="role_id" class="form-control @error('role_id') is-invalid @enderror" required>
                                <option value="">Sélectionnez votre rôle</option>
                                <option value="1" {{ old('role_id') == 1 ? 'selected' : '' }}>Étudiant</option>
                                <option value="2" {{ old('role_id') == 2 ? 'selected' : '' }}>Doctorant</option>
                                <option value="3" {{ old('role_id') == 3 ? 'selected' : '' }}>Personnel administratif</option>
                            </select>
                            @error('role_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-custom w-100 mt-3" style="background-color: rgb(172, 94, 5);font-size: 18px;">S'inscrire</button>
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

