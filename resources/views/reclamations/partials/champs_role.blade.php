@extends('layouts.app')
@section('content')

@if($role->nom === 'Etudiant')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom_etudiant" value="{{ old('nom_etudiant') }}">@error("nom_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom_etudiant" value="{{ old('prenom_etudiant') }}">@error("prenom_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_etudiant" value="{{ old('email_etudiant') }}">@error("email_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="cne" class="form-label">CNE</label>
        <input type="text" class="form-control" name="cne" value="{{ old('cne') }}">@error("cne") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone</label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">@error("telephone") {{$message}} @enderror
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
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom_doctorant" value="{{ old('nom_doctorant') }}">@error("nom_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom_doctorant" value="{{ old('prenom_doctorant') }}">@error("prenom_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_doctorant" value="{{ old('email_doctorant') }}">@error("email_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone personnel</label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">@error("telephone_doctorant") {{$message}} @enderror
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
        <label for="nom" class="form-label">Nom</label>
        <input type="text" class="form-control" name="nom_administratif" value="{{ old('nom_administratif') }}">@error("nom_administratif") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom</label>
        <input type="text" class="form-control" name="prenom_administratif" value="{{ old('prenom_administratif') }}">@error("prenom_administratif") {{$message}} @enderror
    </div>
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel</label>
        <input type="email" class="form-control" name="email_personnel" value="{{ old('email_personnel') }}">@error("email_personnel") {{$message}} @enderror
    </div>
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone personnel/professionnel</label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}">@error("telephone") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="cat_admini" class="form-label">Catégorie administrative</label>
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



@if($typesReclamation->count())
    <div class="mb-3">
        <label for="type_reclamation" class="form-label">Type de réclamation</label>
        <select name="type_reclamation_id" id="type_reclamation_id" class="form-control">
            <option value="" selected readonly>Veuillez préciser l'objet de votre réclamation</option>
            @foreach ($typesReclamation as $type)
                <option value="{{ $type->id }}">{{ $type->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea name="description" class="form-control" placeholder="Écrivez votre réclamation ici..." required></textarea>
    </div>
@else
    <p>Aucun type de réclamation disponible pour ce rôle.</p>
@endif
@endsection












