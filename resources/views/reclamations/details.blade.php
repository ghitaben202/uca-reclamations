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
        .tab {
            display: inline-block;
            padding: 10px 20px;
            cursor: pointer;
            border: none;
            background-color: #f1f1f1;
            color: black;
        }

        .active {
            background-color: #1e3a64; /* Bleu foncé */
            color: white;
        }

        #reponse {
            display: none;
        }
    </style>
</head>
<body>

    <!--NAVBAR-->
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

    <!--SIDEBAR-->
    <div id="sidebar" class=" text-dark p-3">
    @if(auth()->check())
        <p class="text-center user">{{ auth()->user()->nom }}</p>
    @endif
    <ul class="nav flex-column">
            <li class="nav-item" id="list1"><a href="{{ route('dashboard') }}" class="nav-link text-dark">Accueil</a></li>
            <li class="nav-item" id="list2"><a href="{{ route('reclamations.index') }}" class="nav-link text-dark">Mes Reclamations</a></li>
            <li class="nav-item" id="list2"><a href="{{ route('reclamations.ajouterReclamation') }}" class="nav-link text-dark">Ajouter Réclamation</a></li>
        </ul>
    </div>


    <!--CONTENT-->
    <div id="content">
        <div class="container">
            <h4>Détails de la Réclamation</h4>
            <hr>

            <div class="d-flex justify-content-end m-3">
                <button class="tab active d-inline" id="btnContenu" onclick="switchTab('reclamation', this)">Contenu</button>
                <button class="tab d-inline" id="btnReponse" onclick="switchTab('reponse', this)">Réponses</button>
            </div>


            <div class="row px-2">

                <div class="col-md-8" id="reclamation">
                    <div class="details bg-light p-3">
                    <h4 class="">Titre :<span style="font-size:16px; margin-left:10px; color: #6f6d72;">{{ $reclamation->titre }}</span></h4>
                    <hr>
                    <h4 class="">Description :</h4><hr>
                    <span style="font-size:16px; margin-left:10px; color: #6f6d72;">{{ $reclamation->description }}</span>
                    
                    </div>
                </div>

                <div class="col-md-8" id="reponse">
                    <div class="details bg-light p-3">
                    <h4 class="">Titre :<span style="font-size:16px; margin-left:10px; color: #6f6d72;">{{ $reclamation->titre }}</span></h4>
                    <hr>
                    <h4 class="">Date de réponse :<span style="font-size:16px; margin-left:10px; color: #6f6d72;">{{ $reclamation->date_update }}</span></h4>
                    <hr>
                    <h4 class="">Réponse :</h4><hr>
                    <span style="font-size:16px; margin-left:10px; color: #6f6d72;">{{ $reclamation->reponse }}</span>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="infos bg-light p-3">
                    <p class="">Statut :<span style="font-size:16px; margin-left:10px; padding:5px 5px; color:rgb(255, 255, 255);" class="btn btn-warning">{{ $reclamation->statut }}</span></p>
                    <hr>
                    <p class="">Date de soumission :
                    <span style="font-size:14px; margin-left:10px; color:rgb(109, 114, 109);">{{ $reclamation->date_creation}}</span>
                    </p>
                    <hr>
                    <p class="">Catégorie :<span style="font-size:16px; margin-left:10px; padding:5px 5px; color: #6f6d72;">{{ $reclamation->typeReclamation->nom ?? 'Non spécifié' }}
                    </span></p>
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

        function switchTab(tabId, btn) {
            // Cacher tous les contenus
            document.getElementById('reclamation').style.display = 'none';
            document.getElementById('reponse').style.display = 'none';

            // Afficher le contenu correspondant
            document.getElementById(tabId).style.display = 'block';

            // Retirer la classe active des boutons
            document.getElementById('btnContenu').classList.remove('active');
            document.getElementById('btnReponse').classList.remove('active');

            // Ajouter la classe active au bouton cliqué
            btn.classList.add('active');
        }

        // Au chargement de la page, afficher le contenu de la réclamation par défaut
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('reclamation').style.display = 'block';
            document.getElementById('reponse').style.display = 'none';
            document.getElementById('btnContenu').classList.add('active');
        });
    </script>
</body>
</html>