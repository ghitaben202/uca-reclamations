<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
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
            height: 180vh;
            position: absolute;
            background-color: rgba(229, 221, 208, 0.5);
            padding-top: 20px;
            overflow-y: auto;
        }
        #content {
            margin-left: 250px;
            padding: 20px;
        }
        #navb{
            background:rgba(156, 109, 50, 0.83);
        }
        #list1,
        #list2 {
            border-bottom: 1px solid gray;
            padding: 10px;
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
        .logout-link {
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link:hover {
            background-color: rgba(156, 109, 50, 0.83);
            color: white;
        }
        @media (max-width: 768px) {
            #sidebar {
                position: absolute;
                width: 200px;
                z-index: 1000;
                display: none; 
                height: 100vh;
            }
            #content {
                margin-left: 0;
            }
            #toggleSidebar {
                display: inline-block;
            }
            table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
            h4, .btn {
                font-size: 1rem;
            }
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
                    {{ auth()->user()->nom }} {{ auth()->user()->prenom }}
                </button>
            @endif
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item logout-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           <i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a>
                    </li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div id="sidebar" class=" text-dark p-3">
        <ul class="nav flex-column">
            <li class="nav-item" id="list1">
                <a href="{{ route('dashboard') }}" class="nav-link text-dark">
                <i class="fa-solid fa-house" style="color: #0a0a0b;"></i> Accueil</a></li>
            <li class="nav-item" id="list2">
                <a href="#" class="nav-link text-dark">
                <i class="fa-solid fa-folder-open" style="color: #0a0a0b;"></i> Mes Reclamations</a></li>
            <li class="nav-item" id="list2">
                <a href="{{ route('reclamations.ajouterReclamation') }}" class="nav-link text-dark">
                <i class="fa-solid fa-square-plus" style="color: #0a0a0b;"></i> Ajouter Réclamation</a></li>
        </ul>
    </div>
    <div id="content">

    <div class="container">
        <h4>Mes Réclamations</h4>
        <hr>
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <div class="d-flex justify-content-end mb-2"><a href="{{ route('reclamations.ajouterReclamation')}}" class="btn btn-warning ">Ajouter une reclamation +</a></div>
        <div class="bg-light p-3">
        <table id="reclamationsTable" class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Objet</th>
                    <th scope="col">Statut</th>
                    <th scope="col">Date</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reclamations as $reclamation)
                    <tr>
                        <td>{{ $reclamation->id }}</td>
                        <td>{{ $reclamation->titre }}</td>
                        <td>
                            <span class="badge 
                                @if($reclamation->statut == 'en cours') bg-warning
                                @elseif($reclamation->statut == 'clôturée') bg-success
                                @else bg-danger
                                @endif">
                                {{ $reclamation->statut }}
                            </span>
                        </td>
                        <td>{{ $reclamation->date_creation }}</td>
                        <td>
                        <a href="{{ route('reclamations.details', $reclamation->id) }}" class="btn btn-warning">Voir les détails</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>    
    </div>



    </div>
    <script>
        document.getElementById('toggleSidebar').addEventListener('click', function() {
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
        
        $(document).ready(function() {
        $('#reclamationsTable').DataTable({
        "paging": true,      
        "searching": true,   
        "ordering": true,    
        "info": true,        
        "lengthMenu": [5, 10, 25, 50], 
        "language": {
            "sProcessing":     "Traitement en cours...",
            "sSearch":         "Rechercher :",
            "sLengthMenu":     "Afficher _MENU_ éléments",
            "sInfo":           "Affichage de _START_ à _END_ sur _TOTAL_ éléments",
            "sInfoEmpty":      "Affichage de 0 à 0 sur 0 éléments",
            "sInfoFiltered":   "(filtré à partir de _MAX_ éléments au total)",
            "sInfoPostFix":    "",
            "sLoadingRecords": "Chargement en cours...",
            "sZeroRecords":    "Aucun élément à afficher",
            "sEmptyTable":     "Aucune donnée disponible dans le tableau",
            "oPaginate": {
                "sFirst":    "Premier",
                "sPrevious": "Précédent",
                "sNext":     "Suivant",
                "sLast":     "Dernier"
            },
            "oAria": {
                "sSortAscending":  ": activer pour trier la colonne par ordre croissant",
                "sSortDescending": ": activer pour trier la colonne par ordre décroissant"
            }
        }
    });
});

</script>
    </script>
</body>
</html>