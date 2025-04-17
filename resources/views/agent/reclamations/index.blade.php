@extends('layouts.agent')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Liste des Réclamations</h6>
            <div class="btn-group">
                <a href="{{ route('agent.reclamations.index', ['statut' => 'all']) }}" 
                   class="btn btn-outline-primary {{ request('statut') == 'all' || !request('statut') ? 'active' : '' }}">
                    Toutes
                </a>
                <a href="{{ route('agent.reclamations.index', ['statut' => 'en cours']) }}" 
                   class="btn btn-outline-warning {{ request('statut') == 'en cours' ? 'active' : '' }}">
                    En Cours
                </a>
                <a href="{{ route('agent.reclamations.index', ['statut' => 'clôturée']) }}" 
                   class="btn btn-outline-success {{ request('statut') == 'clôturée' ? 'active' : '' }}">
                    Clôturées
                </a>
                <a href="{{ route('agent.reclamations.index', ['statut' => 'rejetée']) }}" 
                   class="btn btn-outline-danger {{ request('statut') == 'rejetée' ? 'active' : '' }}">
                    Rejetées
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="reclamationsTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Titre</th>
                            <th>Statut</th>
                            <th>Date de Création</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reclamations as $reclamation)
                        <tr>
                            <td>{{ $reclamation->id }}</td>
                            <td>{{ $reclamation->sujet }}</td>
                            <td>
                                <span class="badge 
                                    @if($reclamation->statut == 'en cours') bg-warning
                                    @elseif($reclamation->statut == 'clôturée') bg-success
                                    @else bg-danger
                                    @endif">
                                    {{ $reclamation->statut }}
                                </span>
                            </td>
                            <td>{{ \Carbon\Carbon::parse($reclamation->date_creation)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('agent.reclamations.show', $reclamation->id) }}" 
                                   class="btn btn-info btn-sm">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap5.min.css">

<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.bootstrap5.min.js"></script>

<script>
$(document).ready(function() {
    var table = $('#reclamationsTable').DataTable({
        language: {
            url: '//cdn.datatables.net/plug-ins/1.11.5/i18n/fr-FR.json'
        },
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                text: '<i class="fas fa-file-excel"></i> Excel',
                className: 'btn btn-success btn-sm'
            },
            {
                extend: 'pdf',
                text: '<i class="fas fa-file-pdf"></i> PDF',
                className: 'btn btn-danger btn-sm'
            },
            {
                extend: 'print',
                text: '<i class="fas fa-print"></i> Imprimer',
                className: 'btn btn-info btn-sm'
            }
        ],
        order: [[3, 'desc']] // Tri par date de création décroissante
    });
});
</script>
@endsection 