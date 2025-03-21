<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Open Sans', sans-serif;
        }
        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
            background: #343a40;
            padding-top: 20px;
        }
        #content {
            margin-left: 250px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="btn btn-light" id="toggleSidebar">☰</button>
            <div class="ms-auto dropdown">
                <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <i class="fa-solid fa-user"></i>
                    {{ auth()->user()->nom }}
                </button>
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
    <div id="sidebar" class="bg-dark text-white p-3">
        <h4>Menu</h4>
        <ul class="nav flex-column">
            <li class="nav-item"><a href="#" class="nav-link text-white">Accueil</a></li>
            <li class="nav-item"><a href="#" class="nav-link text-white">Mes Reclamations</a></li>
        </ul>
    </div>
    <div id="content">
        <h2>Tableau de bord</h2>
        <p>Bienvenue, {{ auth()->user()->nom }}!</p>
        <hr>

<div class="container">
    <h1>Mon Tableau de Bord</h1>
    
    <div class="row">
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div class="card-body text-light">
                    <h5 class="card-title "><i class="fa-solid fa-bars-progress"></i></i> Réclamations en cours</h5>
                    <p class="card-text">{{ $enCours }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div class="card-body text-light">
                    
                    <h5 class="card-title"><i class="fa-solid fa-square-check"></i> Réclamations clôturées</h5>
                    <p class="card-text">{{ $cloturees }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-secondary">
                <div class="card-body text-light">
                    <h5 class="card-title"> <i class="fa-solid fa-envelope"></i> Mes Réclamations</h5>
                    <p class="card-text">{{ $total }}</p>
                </div>
            </div>
        </div>
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
    </script>
</body>
</html>
