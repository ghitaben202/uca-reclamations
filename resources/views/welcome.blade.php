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
            <div class="p-4 rounded shadow h-100 d-flex flex-column justify-content-center" style=" background-color: rgba(213, 200, 145, 0.5);">
                <h4 class="text-center mb-4 fw-bold ">Connexion</h4>
                <a href="{{ route('login') }}" class="btn btn-warning w-100 ">Se connecter si vous avez un compte</a>
            </div>
        </div>
        <!-- Inscription -->
        <div class="col-lg-5 col-md-6 col-10">
            <div class="p-4 rounded shadow h-100 d-flex flex-column justify-content-center" style="background-color: rgba(213, 200, 145, 0.5);">
                <h4 class="text-center mb-4 fw-bold " >Pas d’email académique ? Inscrivez-vous ici !</h4>
                <a href="{{ route('register') }}" class="btn btn-warning w-100 ">S'inscrire</a>
            </div>
        </div>
    </div>
</div>
@endsection
