@extends('layouts.agent')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" id="reclamation-tab" data-bs-toggle="tab" href="#reclamation">
                        <i class="fas fa-file-alt me-2"></i>Réclamation
                    </a>
                </li>
                @if($reclamation->statut == 'en cours')
                <li class="nav-item">
                    <a class="nav-link" id="repondre-tab" data-bs-toggle="tab" href="#repondre">
                        <i class="fas fa-reply me-2"></i>Répondre
                    </a>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link" id="reponse-tab" data-bs-toggle="tab" href="#reponse">
                        <i class="fas fa-reply me-2"></i>Réponse
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content">
                <!-- Onglet Réclamation -->
                <div class="tab-pane fade show active" id="reclamation">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="text-primary">Informations de la Réclamation</h5>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">ID :</div>
                                    <div class="col-sm-8">{{ $reclamation->id }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Titre :</div>
                                    <div class="col-sm-8">{{ $reclamation->titre }}</div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Statut :</div>
                                    <div class="col-sm-8">
                                        <span class="badge 
                                            @if($reclamation->statut == 'en cours') bg-warning
                                            @elseif($reclamation->statut == 'clôturée') bg-success
                                            @else bg-danger
                                            @endif">
                                            {{ $reclamation->statut }}
                                        </span>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Date de Création :</div>
                                    <div class="col-sm-8">{{ \Carbon\Carbon::parse($reclamation->date_creation)->format('d/m/Y') }}</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4">
                                <h5 class="text-primary">Détails de la Réclamation</h5>
                                <hr>
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Description :</div>
                                    <div class="col-sm-8">{{ $reclamation->description }}</div>
                                </div>
                                @if($reclamation->piece_jointe)
                                <div class="row mb-3">
                                    <div class="col-sm-4 fw-bold">Pièce Jointe :</div>
                                    <div class="col-sm-8">
                                        <a href="{{ asset('storage/' . $reclamation->piece_jointe) }}" 
                                           class="btn btn-sm btn-outline-primary" 
                                           target="_blank">
                                            <i class="fas fa-download"></i> Télécharger
                                        </a>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                @if($reclamation->statut == 'en cours')
                <!-- Onglet Répondre -->
                <div class="tab-pane fade" id="repondre">
                    <form action="{{ route('agent.reclamations.reponse', $reclamation->id) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label for="reponse" class="form-label">Votre Réponse</label>
                            <textarea class="form-control" id="reponse" name="reponse" rows="5" required></textarea>
                        </div>
                        <div class="mb-4">
                            <label for="statut" class="form-label">Changer le Statut</label>
                            <select class="form-select" id="statut" name="statut" required>
                                <option value="clôturée">Clôturer la réclamation</option>
                                <option value="rejetée">Rejeter la réclamation</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Envoyer la Réponse
                        </button>
                    </form>
                </div>
                @else
                <!-- Onglet Réponse -->
                <div class="tab-pane fade" id="reponse">
                    @if($reclamation->reponse)
                        <div class="alert alert-info">
                            <h5 class="alert-heading">Réponse :</h5>
                            <p>{{ $reclamation->reponse }}</p>
                            <hr>
                            <p class="mb-0">
                                <small class="text-muted">
                                    Réponse envoyée le : {{ \Carbon\Carbon::parse($reclamation->updated_at)->format('d/m/Y H:i') }}
                                </small>
                            </p>
                        </div>
                    @else
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle me-2"></i>
                            Aucune réponse n'a été fournie pour cette réclamation.
                        </div>
                    @endif
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection 