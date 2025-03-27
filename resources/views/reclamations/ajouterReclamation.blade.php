<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
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
            min-height: 140vh; 
            position: absolute;
            left:0;
            background-color: rgba(229, 221, 208, 0.5);
            padding-top: 20px;
            overflow-y: auto;
        }
        #content {
            margin-left: 250px;
            padding: 20px;
            flex-grow: 1;
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
    <div id="sidebar" class=" text-dark p-3">
    @if(auth()->check())
        <p class="text-center">{{ auth()->user()->nom }}</p>
    @endif
        <ul class="nav flex-column">
            <li class="nav-item" id="list1"><a href="{{ route('dashboard') }}" class="nav-link text-dark">Accueil</a></li>
            <li class="nav-item" id="list2"><a href="#" class="nav-link text-dark">Mes Reclamations</a></li>
            <li class="nav-item" id="list2"><a href="{{ route('reclamations.ajouterReclamation') }}" class="nav-link text-dark">Ajouter Réclamation</a></li>
        </ul>
    </div>
    <div id="content">

    <div class="container">
        <h4>Ajouter une Réclamation</h4>
        <hr>
        <form method="POST" action="">
            @csrf
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de réclamation</label>
                <input type="text" class="form-control" name="titre" required>
            </div>
            <div class="mb-3">
                <label for="role" class="form-label">Catégorie du réclamant</label>
                <select id="role" name="role" class="form-control">
                    <option value="">Sélectionnez une catégorie</option>
                    <option value="etudiant">Étudiant</option>
                    <option value="enseignant">Enseignant</option>
                    <option value="doctorant">Doctorant</option>
                </select>
            </div>
            <!-- Champs pour Étudiant -->
            <div id="etudiant-fields" class="role-fields" style="display: none;">
                <div class="mb-3">
                    <label for="nom" class="form-label">Nom</label>
                    <input type="text" class="form-control" name="nom">
                </div>
                <div class="mb-3">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input type="text" class="form-control" name="prenom">
                </div>
                <div class="mb-3">
                    <label for="email_personnel" class="form-label">Email personnel</label>
                    <input type="email" class="form-control" name="email_personnel">
                </div>
                <div class="mb-3">
                    <label for="cne" class="form-label">CNE</label>
                    <input type="text" class="form-control" name="cne">
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone">
                </div>
                @php
                    use Illuminate\Support\Facades\DB;
                    $etablissements = DB::table('etablissements')->get();
                    $categorie = request()->input('role');
                    $type_reclamations = DB::table('type_reclamations')
                           ->when($categorie, function ($query, $categorie) {
                               return $query->where('categorie', $categorie);
                           })
                           ->get();
                @endphp
                <div class="mb-3">
                    <label for="etab" class="form-label">Etablissement</label>
                    <select id="etab" name="etab" class="form-control">
                        <option value="">Veuillez choisir votre établissement</option>
                        @foreach ($etablissements as $etablissement)
                            <option value="{{ $etablissement->id }}">{{ $etablissement->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type_reclamation" class="form-label">Type de réclamation</label>
                    <select id="type_reclamation" name="type_reclamation" class="form-control">
                        <option value="">Veuillez choisir...</option>
                        @foreach ($type_reclamations as $type_reclamation)
                            <option value="{{ $type_reclamation->id }}">{{ $type_reclamation->nom }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="contenu" class="form-label">Contenu</label>
                    <textarea name="contenu" id="" cols="115" rows="5"></textarea>
                </div>
            </div>

            <!-- Champs pour Doctorant -->
            <div id="doctorant-fields" class="role-fields" style="display: none;">
                <div class="mb-3">
                    <label for="email_personnel" class="form-label">Email personnel</label>
                    <input type="email" class="form-control" name="email_personnel">
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone">
                </div>
                <div class="mb-3">
                    <label for="ced" class="form-label">Centre d'étude</label>
                    <select name="ced" id="ced" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>
            <!-- Champs pour Adminstratifs -->
            <div id="administratif-fields" class="role-fields" style="display: none;">
                <div class="mb-3">
                    <label for="email_personnel" class="form-label">Email personnel</label>
                    <input type="email" class="form-control" name="email_personnel">
                </div>
                <div class="mb-3">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input type="text" class="form-control" name="telephone">
                </div>
                <div class="mb-3">
                    <label for="ced" class="form-label">Catégorie administrative </label>
                    <select name="ced" id="ced" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="etablissement" class="form-label">Etablissement</label>
                    <select name="etablissement" id="etablissement" class="form-control">
                        <option value=""></option>
                    </select>
                </div>
            </div>

            <button type="submit" class="btn btn-warning">Soumettre</button>
        </form>
        
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
        document.getElementById('role').addEventListener('change', function() {
        let selectedRole = this.value;
        document.querySelectorAll('.role-fields').forEach(fieldset => fieldset.style.display = 'none');

        if (selectedRole === 'etudiant') {
            document.getElementById('etudiant-fields').style.display = 'block';
        }
        if (selectedRole === 'doctorant') {
            document.getElementById('doctorant-fields').style.display = 'block';
        }
        if (selectedRole === 'enseignant') {
            document.getElementById('administratif-fields').style.display = 'block';
        }
        // Ajouter ici l'affichage pour enseignant et doctorant
        });
    </script>
</body>
</html>
