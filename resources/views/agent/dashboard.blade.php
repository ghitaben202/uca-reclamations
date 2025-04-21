@extends('layouts.agent')

@section('content')
<link rel="stylesheet" href="{{ asset('css/statistiques.css') }}">
    <div class="container">
        <div class="statistiques-box">
            <h2 class="titre">Statistiques des Réclamations</h2>
            
            <div class="statistiques-grid">
                <div class="stat-card border-blue">
                    <div class="icon-container bg-blue">
                        <i class="fas fa-clipboard-list text-blue"></i>
                    </div>
                    <div>
                        <p class="label">Total Réclamations</p>
                        <p class="value">{{ $total }}</p>
                    </div>
                </div>

                <div class="stat-card border-yellow">
                    <div class="icon-container bg-yellow">
                        <i class="fas fa-clock text-yellow"></i>
                    </div>
                    <div>
                        <p class="label">En Cours</p>
                        <p class="value">{{ $enCours }}</p>
                    </div>
                </div>

                <div class="stat-card border-green">
                    <div class="icon-container bg-green">
                        <i class="fas fa-check-circle text-green"></i>
                    </div>
                    <div>
                        <p class="label">Clôturées</p>
                        <p class="value">{{ $cloturees }}</p>
                    </div>
                </div>

                <div class="stat-card border-red">
                    <div class="icon-container bg-red">
                        <i class="fas fa-times-circle text-red"></i>
                    </div>
                    <div>
                        <p class="label">Rejetées</p>
                        <p class="value">{{ $rejetees }}</p>
                    </div>
                </div>
            </div>
            <br>
            <div class="dernieres-reclamations">
                <h3 class="titre">Dernières Réclamations</h3>
                <div class="table-wrapper">
                    <table class="styled-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Sujet</th>
                                <th>Statut</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @forelse($recentReclamations as $reclamation)
                                <tr>
                                    <td>{{ $reclamation->id }}</td>
                                    <td>{{ $reclamation->sujet }}</td>
                                    <td>
                                        <span class="badge {{ $reclamation->statut }}">
                                            {{ ucfirst($reclamation->statut) }}
                                        </span>
                                    </td>
                                    <td>
                                        {{ $reclamation->date_creation ? \Carbon\Carbon::parse($reclamation->date_creation)->format('d/m/Y') : 'Non spécifiée' }}
                                    </td>
                                    <td>
                                        <a href="{{ route('agent.reclamations.show', $reclamation) }}" class="voir-lien">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">Aucune réclamation récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

