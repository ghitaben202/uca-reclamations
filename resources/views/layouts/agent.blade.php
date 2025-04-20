<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agent - Tableau de Bord</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
            color: white;
        }
        .sidebar .nav-link {
            color: rgba(255,255,255,.75);
        }
        .sidebar .nav-link:hover {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .sidebar .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,.1);
        }
        .main-content {
            margin-left: 250px;
        }
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                width: 250px;
                z-index: 1000;
                transform: translateX(-100%);
                transition: transform 0.3s ease-in-out;
            }
            .sidebar.show {
                transform: translateX(0);
            }
            .main-content {
                margin-left: 0;
            }
            .overlay {
                display: none;
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0,0,0,0.5);
                z-index: 999;
            }
            .overlay.show {
                display: block;
            }
        }
    </style>
</head>
<body>
    <div class="wrapper d-flex">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="p-3 border-bottom">
                <h4 class="mb-0">Agent Panel</h4>
            </div>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('agent.dashboard') }}" class="nav-link {{ request()->routeIs('agent.dashboard') ? 'active' : '' }}">
                        <i class="fas fa-home me-2"></i> Tableau de Bord
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.reclamations.index') }}" class="nav-link {{ request()->routeIs('agent.reclamations.*') ? 'active' : '' }}">
                        <i class="fas fa-folder-open me-2"></i> Réclamations
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('agent.profile') }}" class="nav-link {{ request()->routeIs('agent.profile') ? 'active' : '' }}">
                        <i class="fas fa-user-cog me-2"></i> Mon Profil
                    </a>
                </li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('agent.logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent">
                            <i class="fas fa-sign-out-alt me-2"></i> Déconnexion
                        </button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Overlay for mobile -->
        <div class="overlay"></div>

        <!-- Main content -->
        <div class="main-content flex-grow-1">
            <!-- Header -->
            <header class="bg-white shadow-sm p-3">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <button class="btn btn-link d-md-none" id="sidebarToggle">
                            <i class="fas fa-bars"></i>
                        </button>
                        <h5 class="mb-0 ms-2">Bienvenue, {{ Auth::guard('agent')->user()->nom }} {{ Auth::guard('agent')->user()->prenom }}</h5>
                    </div>
                    <div class="d-flex align-items-center">
                        <i class="fas fa-user-circle me-2 text-secondary"></i>
                        <span class="text-muted">{{ Auth::guard('agent')->user()->email }}</span>
                    </div>
                </div>
            </header>

            <!-- Page content -->
            <main class="p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.querySelector('.sidebar');
            const overlay = document.querySelector('.overlay');
            const sidebarToggle = document.getElementById('sidebarToggle');

            // Toggle sidebar on mobile
            sidebarToggle.addEventListener('click', function() {
                sidebar.classList.toggle('show');
                overlay.classList.toggle('show');
            });

            // Close sidebar when clicking overlay
            overlay.addEventListener('click', function() {
                sidebar.classList.remove('show');
                overlay.classList.remove('show');
            });

            // Close sidebar when clicking outside on mobile
            document.addEventListener('click', function(e) {
                if (window.innerWidth < 768 && 
                    !sidebar.contains(e.target) && 
                    !sidebarToggle.contains(e.target) &&
                    sidebar.classList.contains('show')) {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                }
            });
        });
    </script>
</body>
</html>
