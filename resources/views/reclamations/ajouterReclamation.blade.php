<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://unpkg.com/htmx.org@1.8.4"></script>
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
            min-height: 180vh; 
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
        textarea {
            min-height: 120px;
            width: 100%;
            resize: vertical;
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
            textarea {
                min-height: 200px;
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
                <a href="{{ route('reclamations.index') }}" class="nav-link text-dark">
                <i class="fa-solid fa-folder-open" style="color: #0a0a0b;"></i> Mes Reclamations</a></li>
            <li class="nav-item" id="list2">
                <a href="#" class="nav-link text-dark">
                <i class="fa-solid fa-square-plus" style="color: #0a0a0b;"></i> Ajouter Réclamation</a></li>
        </ul>
    </div>
    <div id="content">

    <div class="container">
        <h4>Ajouter une Réclamation</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        <hr>
        <form method="POST" action="{{ route('reclamations.store') }}" class="needs-validation" novalidate>
            @csrf
            <div class="mb-3">
                <label for="titre" class="form-label">Titre de réclamation <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('titre') is-invalid @enderror" 
                       name="titre" id="titre" required 
                       minlength="5" maxlength="255"
                       placeholder="Entrez un titre descriptif pour votre réclamation">
                @error('titre')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">Le titre doit contenir entre 5 et 255 caractères.</div>
            </div>

            <div class="mb-3">
                <label for="role" class="form-label">Catégorie du réclamant <span class="text-danger">*</span></label>
                <select id="role" name="role" 
                        class="form-control @error('role') is-invalid @enderror" 
                        hx-post="{{ route('reclamations.getFields') }}"
                        hx-trigger="change"
                        hx-target="#fields-container"
                        hx-swap="innerHTML" required>
                    <option value="" disabled selected>Veuillez choisir votre catégorie</option>
                    @foreach($roles as $role)
                        <option value="{{ $role->nom }}" {{ old('role') == $role->nom ? 'selected' : '' }}>
                            {{ $role->nom }}
                        </option>
                    @endforeach
                </select>
                @error('role')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
                <div class="form-text">Veuillez sélectionner votre catégorie pour afficher les champs spécifiques.</div>
            </div>

            <div id="fields-container">
                @if(old('role'))
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i> Veuillez d'abord sélectionner votre établissement avant de choisir le type de réclamation.
                    </div>
                @endif
            </div>

            <button type="submit" class="btn btn-warning">
                <i class="fas fa-paper-plane me-2"></i>Envoyer la réclamation
            </button>
        </form>

        @if(session('success'))
            <div class="alert alert-success mt-3">
                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger mt-3">
                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
            </div>
        @endif
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
        
        // Validation côté client
        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }
                    form.classList.add('was-validated')
                }, false)
            })
        })()
    </script>
    
</body>
</html>