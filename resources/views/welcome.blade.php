@extends('layouts.app')

@section('content')
<div class="container-fluid text-center py-5">
    <header class="mb-4">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="d-flex mx-auto d-block" width="100">
    </header>
    <h2 class="text-black mb-4 ">Bienvenue dans le porteil U-Réclamations de l'UCA</h2>
    <div class="row justify-content-center gy-4" >
        <!-- Connexion -->
        <div class="col-lg-5 col-md-6 col-10">
            <div class="p-4 rounded shadow" style=" background-color: rgba(213, 200, 145, 0.5);">
                <h4 class="text-center mb-3 fw-bold ">Connexion</h4>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3 text-start">
                        <label class="form-label ">Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                    <div class="mb-3 text-start">
                        <label class="form-label ">Mot de passe</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 ">Se connecter</button>
                    <p class="text-center mt-3">Pas encore inscrit ? <a href="{{ route('register') }}">Créer un compte</a></p>
                </form>
            </div>
        </div>
        <!-- Inscription -->
        <div class="col-lg-5 col-md-6 col-10">
            <div class="p-4 rounded shadow h-100 d-flex flex-column justify-content-center" style="background-color: rgba(213, 200, 145, 0.5);">
                <h4 class="text-center mb-4 fw-bold "  style="margin-top:100px">Pas d’email académique ? Inscrivez-vous ici !</h4>
                <a href="{{ route('register') }}" class="btn btn-warning w-100 ">S'inscrire</a>
            </div>
        </div>
    </div>
</div>
@endsection
