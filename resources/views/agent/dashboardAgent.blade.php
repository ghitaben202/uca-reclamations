<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Agent</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: rgba(229, 221, 208, 0.5);
            font-family: Tahoma, Verdana, sans-serif;
            font-size:16px;
        }
        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background-color: rgba(229, 221, 208, 0.5);
            padding-top: 20px;
        }
        #content {
            margin-left: 250px;
            padding: 20px;
        }
        #navb{
            background:rgba(156, 109, 50, 0.83);
        }
        #list1{
            margin: 0;
            border-top:1px solid gray;
            border-bottom:1px solid gray;
        }
        #list2{
            margin: 0;
            border-bottom:1px solid gray;
        }
        .nav-item a:hover{
            background-color:rgba(234, 213, 192, 0.4);
        }
        #card{
            border:6px solid;
            border-color:white white white rgba(156, 109, 50, 0.83);
        }
        #btn-user{
            background-color:rgba(234, 213, 192, 0.4);
            color:black;
        }
        #toggleSidebar{
         background-color:rgba(234, 213, 192, 0.4);
        }
        p{
            color:rgba(156, 109, 50, 0.83);
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light" id="navb">
        <div class="container-fluid">
            <button class="btn" id="toggleSidebar">☰</button>
            <div class="ms-auto dropdown">
            @if(auth()->check())
                <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" id="btn-user">
                <i class="fa-solid fa-user"></i>
                    {{ auth()->user()->nom }}
                </button>
            @endif
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Déconnexion</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div id="sidebar" class="text-dark p-3">
    @if(auth()->check())
        <p class="text-center">{{ auth()->user()->nom }}</p>
    @endif
    @if(auth()->check())
        <h5 class="text-center fw-bold">{{ Auth::guard('agent')->user()->nom }} {{ Auth::guard('agent')->user()->prenom }}</h5>
    @endif
    <ul class="nav flex-column">
        <li class="nav-item" id="list1"><a href="#" class="nav-link text-dark">Accueil</a></li>
        <li class="nav-item" id="list2"><a href="#" class="nav-link text-dark">Réclamations à traiter</a></li>
    </ul>
</div>

<div id="content">
    <div class="container">
        <h4>Tableau de Bord - Agent</h4>
        <hr>
        <div class="row">
            <div class="col-md-4 mb-2">
                <div class="card bg-white" id="card">
                    <div class="card-body text-dark">
                        <h5 class="card-title"><i class="fa-solid fa-bars-progress"></i> En cours</h5>
                        <p class="card-text">{{ $enCours }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card bg-white" id="card">
                    <div class="card-body text-dark">
                        <h5 class="card-title"><i class="fa-solid fa-square-check"></i> Clôturées</h5>
                        <p class="card-text">{{ $cloturees }}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-2">
                <div class="card bg-white" id="card">
                    <div class="card-body text-dark">
                        <h5 class="card-title"><i class="fa-solid fa-envelope"></i> Total</h5>
                        <p class="card-text">{{ $total }}</p>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mt-4">Réclamations Assignées</h5>
        <input type="text" class="form-control mb-3" placeholder="Rechercher une réclamation..." id="searchInput">

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>ID</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Émetteur</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="reclamationTable">
                @foreach($type_reclamations as $rec)
                    <tr>
                        <td>{{ $rec->id }}</td>
                        <td>{{ $rec->type->nom ?? 'N/A' }}</td>
                        <td>{{ $rec->created_at->format('d/m/Y') }}</td>
                        <td>{{ $rec->utilisateur->nom ?? 'Anonyme' }}</td>
                        <td>
                            @if($rec->statut === 'en cours')
                                <span class="badge bg-warning text-dark">En cours</span>
                            @elseif($rec->statut === 'clôturée')
                                <span class="badge bg-success">Clôturée</span>
                            @else
                                <span class="badge bg-secondary">{{ ucfirst($rec->statut) }}</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('reclamations.show', $rec->id) }}" class="btn btn-sm btn-outline-primary">
                                Consulter
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    document.getElementById('toggleSidebar').addEventListener('click', function () {
        let sidebar = document.getElementById('sidebar');
        let content = document.getElementById('content');
        if (sidebar.style.display === 'none') {
            sidebar.style.display = 'block';
            content.style.marginLeft = '250px';
        } else {
            sidebar.style.display = 'none';
            content.style.marginLeft = '0';
        }
    });

    // Filtre recherche tableau
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let filter = this.value.toLowerCase();
        let rows = document.querySelectorAll('#reclamationTable tr');
        rows.forEach(row => {
            let text = row.textContent.toLowerCase();
            row.style.display = text.includes(filter) ? '' : 'none';
        });
    });
</script>
</body>
</html>



<!-- <div class="max-w-7xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">Statistiques des Réclamations</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
          
                <div class="bg-blue-50 rounded-lg p-6 border-l-4 border-blue-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-blue-100 mr-4">
                            <i class="fas fa-clipboard-list text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Total Réclamations</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $total }}</p>
                        </div>
                    </div>
                </div>
                
                
                <div class="bg-yellow-50 rounded-lg p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-yellow-100 mr-4">
                            <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">En Cours</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $enCours }}</p>
                        </div>
                    </div>
                </div>
                
          
                <div class="bg-green-50 rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-green-100 mr-4">
                            <i class="fas fa-check-circle text-green-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Clôturées</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $cloturees }}</p>
                        </div>
                    </div>
                </div>
        
                <div class="bg-red-50 rounded-lg p-6 border-l-4 border-red-500">
                    <div class="flex items-center">
                        <div class="p-3 rounded-full bg-red-100 mr-4">
                            <i class="fas fa-times-circle text-red-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-gray-500 text-sm">Rejetées</p>
                            <p class="text-2xl font-bold text-gray-800">{{ $rejetees }}</p>
                        </div>
                    </div>
                </div>
            </div>

           
            <div class="mt-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Dernières Réclamations</h3>
                <div class="bg-white rounded-lg shadow overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sujet</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($recentReclamations as $reclamation)
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $reclamation->id }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">{{ $reclamation->sujet }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                            {{ $reclamation->statut === 'en cours' ? 'bg-yellow-100 text-yellow-800' : 
                                               ($reclamation->statut === 'clôturée' ? 'bg-green-100 text-green-800' : 
                                               'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($reclamation->statut) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        {{ $reclamation->date_creation ? \Carbon\Carbon::parse($reclamation->date_creation)->format('d/m/Y') : 'Non spécifiée' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                        <a href="{{ route('agent.reclamations.show', $reclamation) }}" class="text-blue-600 hover:text-blue-900">
                                            <i class="fas fa-eye"></i> Voir
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">Aucune réclamation récente</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> -->
    
<!--<script>
    function toggle() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            }

            toggleSidebar.addEventListener('click', toggle);
            if (mobileSidebarToggle) mobileSidebarToggle.addEventListener('click', toggle);
            overlay.addEventListener('click', toggle);

            document.addEventListener('click', function (e) {
                if (window.innerWidth < 768 &&
                    !sidebar.contains(e.target) &&
                    !toggleSidebar.contains(e.target) &&
                    !mobileSidebarToggle.contains(e.target)) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });
    </script> -->
