<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') - SMA Negeri Unggulan</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <style>
        :root {
            --sidebar-width: 280px;
            --primary-color: #5a6acf;
            --secondary-color: #8b5cf6;
            --success-color: #00d4aa;
            --info-color: #00cae3;
            --warning-color: #ffc107;
            --danger-color: #ff4c51;
            --dark-color: #495057;
            --light-color: #f8f9fa;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f6f9;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--secondary-color) 100%);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            z-index: 1000;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .sidebar-brand {
            color: white;
            text-decoration: none;
            font-size: 1.25rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .sidebar-brand:hover {
            color: white;
        }

        .sidebar-nav {
            padding: 1rem 0;
        }

        .nav-link {
            color: rgba(255,255,255,0.8);
            padding: 0.75rem 1.5rem;
            border-radius: 0;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .nav-link:hover,
        .nav-link.active {
            color: white;
            background-color: rgba(255,255,255,0.1);
            border-left: 4px solid white;
            padding-left: calc(1.5rem - 4px);
        }

        .nav-link i {
            width: 20px;
            text-align: center;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            transition: all 0.3s ease;
        }

        /* Navbar */
        .navbar {
            background: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1rem 1.5rem;
        }

        .navbar-brand {
            color: var(--dark-color);
            font-weight: 600;
        }

        .dropdown-toggle::after {
            display: none;
        }

        .dropdown-menu {
            border: none;
            box-shadow: 0 5px 25px rgba(0,0,0,0.1);
            border-radius: 10px;
        }

        /* Content Area */
        .content {
            padding: 2rem;
        }

        /* Cards */
        .card {
            border: none;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            border-radius: 15px;
        }

        .card-header {
            background: transparent;
            border-bottom: 1px solid rgba(0,0,0,0.1);
            padding: 1.5rem;
            font-weight: 600;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Stats Cards */
        .stats-card {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border-radius: 15px;
            padding: 1.5rem;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            width: 100px;
            height: 100px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
            transform: translate(30px, -30px);
        }

        .stats-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .stats-icon {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 2rem;
            opacity: 0.3;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .sidebar {
                margin-left: calc(-1 * var(--sidebar-width));
            }

            .sidebar.show {
                margin-left: 0;
            }

            .main-content {
                margin-left: 0;
            }

            .content {
                padding: 1rem;
            }
        }

        /* Button Styles */
        .btn {
            border-radius: 8px;
            padding: 0.5rem 1.25rem;
            font-weight: 500;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border: none;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--secondary-color), var(--primary-color));
            transform: translateY(-1px);
            box-shadow: 0 5px 15px rgba(90, 106, 207, 0.3);
        }

        /* Toast Notifications */
        .toast {
            border-radius: 10px;
            border: none;
        }

        /* Page Header */
        .page-header {
            background: white;
            padding: 1.5rem 2rem;
            margin: -2rem -2rem 2rem -2rem;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .page-title {
            margin: 0;
            color: var(--dark-color);
            font-weight: 600;
        }

        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
        }

        .breadcrumb-item + .breadcrumb-item::before {
            color: #6c757d;
        }
    </style>

    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <a href="{{ route('dashboard') }}" class="sidebar-brand">
                <i class="fas fa-graduation-cap"></i>
                <span>SMA Unggulan</span>
            </a>
        </div>
        
        <nav class="sidebar-nav">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="fas fa-tachometer-alt"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard.contents.index') }}">
                <i class="fas fa-newspaper"></i>
                        <span>Content Management</span>
                    </a>
                </li>
                
                <!--<li class="nav-item">
                    <a class="nav-link" href="#" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-images"></i>
                        <span>Galeri Management</span>
                    </a>
                </li>-->
                
                @role('super admin')
                <li class="nav-item">
                    <a class="nav-link" href="#" onclick="alert('Fitur akan segera hadir!')">
                        <i class="fas fa-users"></i>
                        <span>User Management</span>
                    </a>
                </li>
                @endrole
            </ul>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Top Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light">
            <button class="btn btn-link d-lg-none" type="button" id="sidebarToggle">
                <i class="fas fa-bars"></i>
            </button>
            
            <div class="navbar-brand d-lg-none">
                Dashboard
            </div>

            <div class="ms-auto">
                <div class="dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" 
                       data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="me-3 text-end d-none d-sm-block">
                            <div class="fw-semibold">{{ Auth::user()->name }}</div>
                            <small class="text-muted">{{ ucfirst(Auth::user()->getRoleNames()->first()) }}</small>
                        </div>
                        <div class="avatar bg-primary text-white rounded-circle d-flex align-items-center justify-content-center" 
                             style="width: 40px; height: 40px;">
                            <i class="fas fa-user"></i>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><h6 class="dropdown-header">{{ Auth::user()->name }}</h6></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="alert('Fitur akan segera hadir!')">
                                <i class="fas fa-user-circle me-2"></i>Profile
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#" onclick="alert('Fitur akan segera hadir!')">
                                <i class="fas fa-cog me-2"></i>Settings
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="fas fa-sign-out-alt me-2"></i>Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <!-- Page Content -->
        <div class="content">
            @yield('content')
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JS -->
    <script>
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('show');
        });

        // Auto-hide alerts
        setTimeout(function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                const bsAlert = new bootstrap.Alert(alert);
                bsAlert.close();
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>