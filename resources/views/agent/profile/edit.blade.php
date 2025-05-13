@extends('layouts.agent')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <!-- Informations du profil -->
        <div class="col-md-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header" style="background-color: #F5DEB3; color: #333;">
                    <h5 class="mb-0">Informations du profil</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('agent.profile.update') }}">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="nom" class="form-label">Nom</label>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                id="nom" name="nom" value="{{ old('nom', $agent->nom) }}" required>
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="prenom" class="form-label">Prénom</label>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                id="prenom" name="prenom" value="{{ old('prenom', $agent->prenom) }}" required>
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Nom d'utilisateur</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror" 
                                id="username" name="username" value="{{ old('username', $agent->username) }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Type de réclamations</label>
                            <div class="form-control bg-light">
                                <div class="mb-1">
                                    <span class="badge bg-primary">{{ $typeReclamation->nom }}</span>
                                </div>
                                <small class="text-muted">{{ $typeReclamation->description }}</small>
                            </div>
                        </div>

                        <!-- Bouton pour afficher/masquer les champs de mot de passe -->
                        <div class="mb-3">
                            <button type="button" class="btn btn-outline-secondary" id="togglePasswordFields">
                                <i class="fas fa-key me-2"></i>Changer le mot de passe
                            </button>
                        </div>

                        <!-- Champs de mot de passe (initialement masqués) -->
                        <div id="passwordFields" style="display: none;">
                            <div class="mb-3">
                                <label for="current_password" class="form-label">Mot de passe actuel</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror" 
                                    id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nouveau mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" 
                                    id="password" name="password">
                                <div class="form-text">
                                    Le mot de passe doit contenir :
                                    <ul class="mb-0">
                                        <li>Au moins 8 caractères</li>
                                        <li>Au moins une lettre majuscule</li>
                                        <li>Au moins une lettre minuscule</li>
                                        <li>Au moins un chiffre</li>
                                        <li>Au moins un caractère spécial (@$!%*?&)</li>
                                    </ul>
                                </div>
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmer le nouveau mot de passe</label>
                                <input type="password" class="form-control" 
                                    id="password_confirmation" name="password_confirmation">
                            </div>
                        </div>

                        <button type="submit" class="btn" style="background-color: #F5DEB3; color: #333;">Mettre à jour le profil</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Statistiques -->
        <div class="col-md-8">
            <div class="row">
                <!-- Carte des statistiques -->
                <div class="col-12 mb-4">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #F5DEB3; color: #333;">
                            <h5 class="mb-0">Statistiques des réclamations</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="card" style="background-color: #4A90A4;">
                                        <div class="card-body text-center">
                                            <h3 class="text-white">{{ $totalReclamations }}</h3>
                                            <p class="mb-0 text-white">Total</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card" style="background-color: #F5A86C;">
                                        <div class="card-body text-center">
                                            <h3 class="text-white">{{ $enCours }}</h3>
                                            <p class="mb-0 text-white">En cours</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card" style="background-color: #8ABF8E;">
                                        <div class="card-body text-center">
                                            <h3 class="text-white">{{ $cloturees }}</h3>
                                            <p class="mb-0 text-white">Clôturées</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="card" style="background-color: #E98B8B;">
                                        <div class="card-body text-center">
                                            <h3 class="text-white">{{ $rejetees }}</h3>
                                            <p class="mb-0 text-white">Rejetées</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dernières réclamations -->
                <div class="col-12">
                    <div class="card shadow-sm">
                        <div class="card-header" style="background-color: #F5DEB3; color: #333;">
                            <h5 class="mb-0">Dernières réclamations traitées</h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Date</th>
                                            <th>Statut</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($recentReclamations as $reclamation)
                                            <tr>
                                                <td>#{{ $reclamation->id }}</td>
                                                <td>{{ $reclamation->updated_at ? $reclamation->updated_at->format('d/m/Y H:i') : 'N/A' }}</td>
                                                <td>
                                                    <span class="badge bg-{{ $reclamation->statut === 'en cours' ? 'warning' : ($reclamation->statut === 'clôturée' ? 'success' : 'danger') }}">
                                                        {{ $reclamation->statut }}
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('agent.reclamations.show', $reclamation) }}" 
                                                       class="btn btn-sm" style="background-color: #F5DEB3; color: #333;">
                                                        Voir
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="text-center">Aucune réclamation récente</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    // Fonction pour initialiser le comportement du bouton
    function initPasswordToggle() {
        const toggleButton = document.getElementById('togglePasswordFields');
        const passwordFields = document.getElementById('passwordFields');
        
        if (!toggleButton || !passwordFields) {
            console.error('Éléments non trouvés:', { toggleButton, passwordFields });
            return;
        }
        
        console.log('Éléments trouvés:', { toggleButton, passwordFields });
        
        toggleButton.onclick = function() {
            console.log('Bouton cliqué');
            const isHidden = passwordFields.style.display === 'none';
            
            passwordFields.style.display = isHidden ? 'block' : 'none';
            toggleButton.innerHTML = isHidden 
                ? '<i class="fas fa-times me-2"></i>Annuler le changement de mot de passe'
                : '<i class="fas fa-key me-2"></i>Changer le mot de passe';
            toggleButton.classList.toggle('btn-outline-danger', isHidden);
            toggleButton.classList.toggle('btn-outline-secondary', !isHidden);
            
            if (!isHidden) {
                // Réinitialiser les champs si on cache
                document.getElementById('current_password').value = '';
                document.getElementById('password').value = '';
                document.getElementById('password_confirmation').value = '';
            }
        };
    }

    // Initialiser au chargement de la page
    document.addEventListener('DOMContentLoaded', initPasswordToggle);
</script>
@endsection 