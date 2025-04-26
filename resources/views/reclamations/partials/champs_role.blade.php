@extends('layouts.app')
@section('content')

@if($role->nom === 'Etudiant')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom">
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom">
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_personnel">
    </div>
    <div class="mb-3">
        <label for="cne" class="form-label">CNE</label>
        <input type="text" class="form-control" name="cne">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone">
    </div>
    <div class="mb-3">
        <label for="etab" class="form-label">Etablissement</label>
        <select id="etab" name="etab" class="form-control">
            <option value="" selected readonly>Veuillez choisir votre établissement</option>
                @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                @endforeach
        </select>
    </div>
@endif

@if($role->nom === 'Doctorant')
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_personnel">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone">
    </div>
    <div class="mb-3">
        <label for="ced" class="form-label">Centre d'étude</label>
        <select name="ced" id="ced" class="form-control">
            <option value="" selected readonly>Sélectionnez un centre d'étude</option>
            @foreach ($ced as $centre)
                <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
            @endforeach
        </select>
    </div>
@endif

@if($role->nom === 'Administratif')
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_personnel">
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone">
    </div>
    <div class="mb-3">
        <label for="cat_admini" class="form-label">Catégorie administrative </label>
        <select name="cat_admini" id="cat_admini" class="form-control">
            <option value="" selected readonly>Sélectionnez une catégorie</option>
            <option value="administratif">Administratif</option>
            <option value="enseignant">Enseignant</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="etablissement" class="form-label">Etablissement</label>
        <select name="etablissement" id="etablissement" class="form-control">
            <option value="" selected redonly>Veuillez choisir l'établissement</option>
                @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                @endforeach
        </select>
    </div>
@endif



{{-- Le select rempli dynamiquement à partir de la base de données --}}
@if($typesReclamation->count())
    <div class="mb-3">
        <label for="type_reclamation" class="form-label">Type de réclamation</label>
        <select name="type_reclamation" id="type_reclamation" class="form-control">
            @foreach ($typesReclamation as $type)
                <option value="{{ $type->id }}">{{ $type->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="contenu" class="form-label">Contenu</label>
        <textarea name="contenu" class="form-control" placeholder="Écrivez votre réclamation ici..." required></textarea>
    </div>
@else
    <p>Aucun type de réclamation disponible pour ce rôle.</p>
@endif
@endsection












