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
            @else
            <button class="btn btn-secondary" type="button">
                <i class="fa-solid fa-user"></i> Invité
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
    <div id="sidebar" class=" text-dark p-3">
    @if(auth()->check())
        <p class="text-center">{{ auth()->user()->nom }}</p>
    @else
        <p>Bienvenue, invité !</p>
    @endif
        <ul class="nav flex-column">
            <li class="nav-item" id="list1"><a href="#" class="nav-link text-dark">Accueil</a></li>
            <li class="nav-item" id="list2"><a href="{{ route('reclamations.index') }}" class="nav-link text-dark">Mes Reclamations</a></li>
        </ul>
    </div>
    <div id="content">

    <div class="container">
    <h4>Mon Tableau de Bord</h4>
    <hr>
    <div class="row">
        <div class="col-md-4 mb-2">
            <div class="card bg-white" id="card">
                <div class="card-body text-dark">
                    <h5 class="card-title "><i class="fa-solid fa-bars-progress"></i></i> Réclamations en cours</h5>
                    <p class="card-text">{{ $enCours }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card bg-white" id="card">
                <div class="card-body text-dark">
                    
                    <h5 class="card-title"><i class="fa-solid fa-square-check"></i> Réclamations clôturées</h5>
                    <p class="card-text">{{ $cloturees }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-2">
            <div class="card bg-white" id="card">
                <div class="card-body text-dark">
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
