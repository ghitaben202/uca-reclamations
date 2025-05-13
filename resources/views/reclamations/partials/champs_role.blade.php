@extends('layouts.app')
@section('content')

@if($role->nom === 'Etudiant')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nom_etudiant" value="{{ old('nom_etudiant') }}" required>@error("nom_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="prenom_etudiant" value="{{ old('prenom_etudiant') }}" required>@error("prenom_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email_etudiant" value="{{ old('email_etudiant') }}" required>@error("email_etudiant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="cne" class="form-label">CNE <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="cne" value="{{ old('cne') }}" required>@error("cne") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>@error("telephone") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="etab" class="form-label">Etablissement <span class="text-danger">*</span></label>
        <select id="etab" name="etab" class="form-control" required>
            <option value="" selected readonly>Veuillez choisir votre établissement</option>
                @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                @endforeach
        </select>
    </div>
@endif

@if($role->nom === 'Doctorant')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nom_doctorant" value="{{ old('nom_doctorant') }}" required>@error("nom_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="prenom_doctorant" value="{{ old('prenom_doctorant') }}" required>@error("prenom_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email_doctorant" value="{{ old('email_doctorant') }}" required>@error("email_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone personnel <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>@error("telephone_doctorant") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="ced" class="form-label">Centre d'étude <span class="text-danger">*</span></label>
        <select name="ced" id="ced" class="form-control" required>
            <option value="" selected readonly>Sélectionnez un centre d'étude</option>
            @foreach ($ced as $centre)
                <option value="{{ $centre->id }}">{{ $centre->nom }}</option>
            @endforeach
        </select>
    </div>
@endif

@if($role->nom === 'Administratif')
    <div class="mb-3">
        <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="nom_administratif" value="{{ old('nom_administratif') }}" required>@error("nom_administratif") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="prenom" class="form-label">Prénom <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="prenom_administratif" value="{{ old('prenom_administratif') }}" required>@error("prenom_administratif") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email personnel <span class="text-danger">*</span></label>
        <input type="email" class="form-control" name="email_personnel" value="{{ old('email_personnel') }}" required>@error("email_personnel") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="email_personnel" class="form-label">Email académique</label>
        <input type="email" class="form-control" name="email_academique" value="{{ old('email_academique') }}">@error("email_academique") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="telephone" class="form-label">Téléphone personnel/professionnel <span class="text-danger">*</span></label>
        <input type="text" class="form-control" name="telephone" value="{{ old('telephone') }}" required>@error("telephone") {{$message}} @enderror
    </div>
    <div class="mb-3">
        <label for="cat_admini" class="form-label">Catégorie administrative <span class="text-danger">*</span></label>
        <select name="cat_admini" id="cat_admini" class="form-control" required>
            <option value="" selected readonly>Sélectionnez une catégorie</option>
            <option value="administratif">Administratif</option>
            <option value="enseignant">Enseignant</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="etablissement" class="form-label">Etablissement <span class="text-danger">*</span></label>
        <select name="etablissement" id="etablissement" class="form-control" required>
            <option value="" selected readonly>Veuillez choisir l'établissement</option>
                @foreach ($etablissements as $etablissement)
                    <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                @endforeach
        </select>
    </div>
@endif

@if($typesReclamation->count())
    <div class="mb-3">
        <label for="type_reclamation" class="form-label">Type de réclamation <span class="text-danger">*</span></label>
        <select name="type_reclamation_id" id="type_reclamation_id" class="form-control" required>
            <option value="" selected readonly>Veuillez préciser l'objet de votre réclamation</option>
            @foreach ($typesReclamation as $type)
                <option value="{{ $type->id }}" data-agent-id="{{ $type->agent_id }}">{{ $type->nom }}</option>
            @endforeach
        </select>
    </div>
    <div class="mb-3">
        <label for="description" class="form-label">Description <span class="text-danger">*</span></label>
        <textarea name="description" class="form-control" placeholder="Écrivez votre réclamation ici..." required></textarea>
    </div>
    <input type="hidden" name="agent_id" id="agent_id">
@else
    <p>Aucun type de réclamation disponible pour ce rôle.</p>
@endif

<script>
document.getElementById('type_reclamation_id').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const agentId = selectedOption.getAttribute('data-agent-id');
    document.getElementById('agent_id').value = agentId;
});
</script>
@endsection











