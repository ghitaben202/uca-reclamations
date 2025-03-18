<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un compte</title>
    
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
                <div class="card card-custom shadow w-100">
                    <img src="{{asset('images/logo.jpeg')}}" alt="Register" class="img-fluid mb-3 d-block mx-auto" style="max-height: 150px;">
                    <h5>Vous n'avez pas d'email académique ?</h5>
                    <h3 class="fw-bold">Créer un compte</h3>
                </div>
            </div>

            <!-- Formulaire -->
            <div class="col-md-6 ">
                <div class="card card-custom shadow w-100">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{!! $error !!}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="mb-3 text-start">
                            <label for="nom" class="form-label">Nom</label>
                            <input id="nom" type="text" name="nom" value="{{ old('nom') }}" required autofocus class="form-control">
                        </div>

                        <div class="mb-3 text-start">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input id="prenom" type="text" name="prenom" value="{{ old('prenom') }}" required class="form-control">
                        </div>

                        <div class="mb-3 text-start">
                            <label for="email_personnel" class="form-label">Email personnel</label>
                            <input id="email_personnel" type="email" name="email_personnel" value="{{ old('email_personnel') }}" required class="form-control">
                        </div>

                        <div class="mb-3 text-start">
                            <label for="mot_de_passe" class="form-label">Mot de passe</label>
                            <input id="mot_de_passe" type="password" name="mot_de_passe" required class="form-control">
                        </div>

                        <button type="submit" class="btn btn-custom w-100 mt-3">S'inscrire</button>
                    </form>
                </div>
            </div> 

        </div>
    </div>

</body>
</html>
