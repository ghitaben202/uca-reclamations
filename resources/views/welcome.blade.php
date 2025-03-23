@extends('layouts.app')

@section('content')
<div class="container-fluid py-5" > <!-- Light beige background -->
    <header class="mb-4">
        <img src="{{ asset('images/logo.jpeg') }}" alt="Logo" class="d-flex mx-auto d-block" width="150px" style="border: 3px solid  rgba(172, 94, 5, 0.8); border-radius: 0px; box-shadow: 4px 4px 10px rgba(0, 0, 0, 0.3);">
    </header>
    <h1 class="text-black text-center mb-5" style="font-size: 3rem; padding-left: 20px; padding-right: 20px;">
        Bienvenue dans le portail <strong style="font-weight: bold; color: rgb(172, 94, 5);">UCA-Réclamations</strong> de l'Université Cadi Ayyad
    </h1>
    <div style="padding: 20px; margin: auto; width:80%" class="d-flex justify-content-right align-items-center">
        <p style="font-size: 20px; font-weight:80%; color : gray;">
        Pour toute réclamation concernant la Cité Universitaire, une plateforme dédiée est mise en place pour recueillir vos demandes.<br>
        <strong>UCA-Réclamations</strong> est accessible via authentification depuis un mobile ou un ordinateur, en utilisant les adresses mail académiques de l'université ou personnels.
        </p>
    </div>
    <div class="row justify-content-center gy-4 text-center">
        <!-- Connexion -->
        <div class="col-lg-5 col-md-6 col-10">
            <div class="p-4 rounded shadow h-100 d-flex flex-column justify-content-center" style="background-color: rgb(255, 255, 255, 0.6);">
                <h4 class="text-center mb-4 fw-bold" style="font-size: 18px;">Connexion</h4>
                <a href="{{ route('login') }}" class="btn w-100 text-light fw-bolder" style="background-color: rgb(172, 94, 5);font-size: 18px;">Se connecter si vous avez un compte</a>
            </div>
        </div>
        <!-- Inscription -->
        <div class="col-lg-5 col-md-6 col-10">
            <div class="p-4 rounded shadow h-100 d-flex flex-column justify-content-center" style="background-color: rgb(255, 255, 255, 0.6);">
                <h4 class="text-center mb-4 fw-bold" style="font-size: 18px;">Pas d’email académique ? Inscrivez-vous ici !</h4>
                <a href="{{ route('register') }}" class="btn w-100 text-light fw-bolder" style="background-color: rgb(172, 94, 5); font-size: 18px;">S'inscrire</a>
            </div>
        </div>
    </div>
</div>
<footer class="text-center p-3">
    © Copyright 2025 <strong>UCA</strong>. Tous droits réservés.
</footer>
@endsection