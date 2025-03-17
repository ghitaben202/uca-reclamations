@extends('layouts.app')

@section('content')
<div class="container-fluid text-center" style="background-color:rgba(229, 221, 208, 0.5);height:600px">
    <header>
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="mb-4 d-flex mx-auto d-block" width="100">
    </header>

    <div class="row justify-content-center" >
        <h2 class="text-black mb-4 ">Bienvenue dans le porteil U-Réclamations de l'UCA</h2>
        <div class="col-md-5">
            <div class="p-4" style=" background-color: rgba(213, 200, 145, 0.5);">
                <h4 class="text-center mb-3 fw-bold ">Connexion</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label ">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label ">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 ">Se connecter</button>
                    <p class="text-center mt-3">Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></p>
                </form>
            </div>
        </div>
        <div class="col-md-5" style=" background-color: rgba(213, 200, 145, 0.5);">
            <h4 class="text-center mb-4 fw-bold "  style="margin-top:100px">Pas d’email académique ? Inscrivez-vous ici !</h4>
            <a href="{{ route('register') }}" class="btn btn-warning w-100 ">S'inscrire</a>
        </div>
    </div>
</div>
@endsection
