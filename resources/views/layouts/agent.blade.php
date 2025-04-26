<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent - Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            background: rgba(229, 221, 208, 0.5);
            font-family: 'Open Sans', Tahoma, sans-serif;
            font-size: 16px;
        }

        #sidebar {
            width: 250px;
            min-height: 250vh; 
            position: absolute;
            left:0;
            background-color: rgba(229, 221, 208, 0.5);
            padding-top: 20px;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        #content {
            margin-left: 250px;
            padding: 20px;
        }

        #navb {
            background: rgba(156, 109, 50, 0.83);
        }

        .nav-link {
            color: black;
            border-bottom: 1px solid gray;
            padding: 12px 20px;
        }

        .nav-link:hover, .nav-link.active {
            background-color: rgba(234, 213, 192, 0.4);
            color: black;
        }

        .card-custom {
            border: 6px solid;
            border-color: white white white rgba(156, 109, 50, 0.83);
            background-color: white;
        }

        h4, h5, p {
            color: rgba(156, 109, 50, 0.83);
        }

        #btn-user, #toggleSidebar {
            background-color: rgba(234, 213, 192, 0.4);
            color: black;
        }
        .logout-link {
            background-color: transparent;
            transition: background-color 0.3s, color 0.3s;
        }

        .logout-link:hover {
            background-color: rgba(156, 109, 50, 0.83); /* fond rouge au survol */
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

            #sidebar.active {
                transform: translateX(0);
            }
            #content {
                margin-left: 0;
            }

            #toggleSidebar {
                display: block;
                position: absolute;
                top: 10px;
                left: 10px;
                z-index: 1000;
                cursor: pointer;
            }
        }
        @media (max-width: 768px) {
            .card-header .btn-group {
                flex-wrap: wrap;
                gap: 5px;
            }
            .card-header h5 {
                font-size: 18px;
            }
            .table-responsive {
                overflow-x: auto;
            }
            #reclamationsTable th,
            #reclamationsTable td {
                white-space: nowrap;
            }
            .dt-buttons {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
                justify-content: center;
                margin-bottom: 10px;
            }
            .dataTables_wrapper .dataTables_filter {
                text-align: center;
            }
            .dataTables_wrapper .dataTables_filter input {
                width: 100%;
                max-width: 250px;
                margin-top: 5px;
            }
        }
    </style>
</head>
<body>
   
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light" id="navb">
            <div class="container-fluid">
                <button class="btn" id="toggleSidebar">☰</button>
                <div class="ms-auto dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" id="btn-user">
                        <i class="fa-solid fa-user"></i> {{ Auth::guard('agent')->user()->nom }} {{ Auth::guard('agent')->user()->prenom }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item logout-link" href="{{ route('agent.logout')  }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fas fa-sign-out-alt me-2"></i>Déconnexion</a>
                        </li>
                        <form id="logout-form" action="{{ route('agent.logout')  }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->
        <div id="sidebar" class="text-dark p-3">
            <ul class="nav flex-column">
                <li class="nav-item" id="list1">
                    <a href="{{ route('agent.dashboard') }}" class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Tableau de Bord
                    </a>
                </li>
                <li class="nav-item" id="list2">
                    <a href="{{ route('agent.reclamations.index') }}" class="nav-link {{ request()->routeIs('agent.reclamations.*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open me-2"></i> Réclamations
                    </a>
                </li>
                <li class="nav-item" id="list2">
                    <a href="{{ route('agent.profile') }}" class="nav-link {{ request()->routeIs('agent.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog me-2"></i> Mon Profil
                    </a>
                </li>
            </ul>
        </div>

        <!-- Overlay for mobile -->
        <div class="overlay" id="sidebarOverlay"></div>

        <!-- Content -->
        <div id="content">

            <main>
                @yield('content')
            </main>
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