<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel - Desa Sawotratap')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2d5016;
            --secondary-green: #3d6b1f;
            --light-green: #4a7c24;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f8f9fa;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, var(--primary-green) 0%, var(--secondary-green) 100%);
            color: white;
            padding: 0;
            overflow-y: auto;
            z-index: 1000;
            box-shadow: 4px 0 15px rgba(0,0,0,0.1);
        }

        .admin-sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .admin-sidebar::-webkit-scrollbar-track {
            background: rgba(255,255,255,0.1);
        }

        .admin-sidebar::-webkit-scrollbar-thumb {
            background: rgba(255,255,255,0.3);
            border-radius: 3px;
        }

        .sidebar-header {
            padding: 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            background: rgba(0,0,0,0.1);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            text-decoration: none;
            color: white;
        }

        .sidebar-brand-icon {
            width: 45px;
            height: 45px;
            background: white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-green);
            font-size: 1.5rem;
        }

        .sidebar-brand-text h5 {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .sidebar-brand-text p {
            margin: 0;
            font-size: 0.75rem;
            opacity: 0.8;
        }

        .sidebar-menu {
            padding: 1rem 0;
        }

        .menu-section-title {
            padding: 1rem 1.5rem 0.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            font-weight: 600;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.85rem 1.5rem;
            color: rgba(255,255,255,0.85);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .menu-item i {
            font-size: 1.2rem;
            width: 30px;
        }

        .menu-item:hover {
            background: rgba(255,255,255,0.1);
            color: white;
            padding-left: 2rem;
        }

        .menu-item.active {
            background: rgba(255,255,255,0.15);
            color: white;
            border-left: 4px solid white;
            padding-left: calc(1.5rem - 4px);
        }

        .menu-item.active::before {
            content: '';
            position: absolute;
            right: 1rem;
            width: 6px;
            height: 6px;
            background: white;
            border-radius: 50%;
        }

        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 0;
        }

        .admin-topbar {
            background: white;
            padding: 1rem 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-title h4 {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #2c3e50;
        }

        .topbar-title p {
            margin: 0;
            font-size: 0.85rem;
            color: #6c757d;
        }

        .topbar-user {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-info {
            text-align: right;
        }

        .user-info .name {
            font-weight: 600;
            color: #2c3e50;
            font-size: 0.95rem;
        }

        .user-info .role {
            font-size: 0.75rem;
            color: #6c757d;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.3rem;
        }

        .content-wrapper {
            padding: 2rem;
        }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #f0f0f0;
        }

        .card-header-custom h5 {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #2c3e50;
        }

        /* Buttons */
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-green), var(--secondary-green));
            border: none;
            font-weight: 600;
            padding: 0.6rem 1.5rem;
            border-radius: 8px;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(45, 80, 22, 0.3);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }

            .admin-sidebar.show {
                transform: translateX(0);
            }

            .admin-content {
                margin-left: 0;
            }

            .topbar-user .user-info {
                display: none;
            }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <i class="bi bi-house-heart-fill"></i>
                </div>
                <div class="sidebar-brand-text">
                    <h5>Desa Sawotratap</h5>
                    <p>Admin Panel</p>
                </div>
            </a>
        </div>

        <!-- Sidebar Menu -->
        <div class="sidebar-menu">
            <div class="menu-section-title">Dashboard</div>
            <a href="{{ route('admin.dashboard') }}" class="menu-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>

            <div class="menu-section-title">Konten</div>
            <a href="{{ route('admin.announcements.index') }}" class="menu-item {{ request()->routeIs('admin.announcements.*') ? 'active' : '' }}">
                <i class="bi bi-megaphone"></i> Pengumuman
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-newspaper"></i> Berita
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-images"></i> Galeri
            </a>
            
            <div class="menu-section-title">UMKM</div>
            <a href="{{ route('admin.umkm.index') }}" class="menu-item {{ request()->routeIs('admin.umkm.*') ? 'active' : '' }}">
                <i class="bi bi-shop"></i> Kelola UMKM
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-tags"></i> Kategori UMKM
            </a>

            <div class="menu-section-title">Lainnya</div>
            <a href="#" class="menu-item">
                <i class="bi bi-people"></i> Pengguna
            </a>
            <a href="#" class="menu-item">
                <i class="bi bi-gear"></i> Pengaturan
            </a>

            <div class="menu-section-title">Akun</div>
            <a href="{{ route('home') }}" class="menu-item">
                <i class="bi bi-arrow-left-circle"></i> Kembali ke Website
            </a>
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content">
        <!-- Topbar -->
        <div class="admin-topbar">
            <div class="topbar-title">
                <h4>@yield('page-title', 'Dashboard')</h4>
                <p>@yield('page-description', 'Kelola konten website desa')</p>
            </div>
            <div class="topbar-user">
                <div class="user-info">
                    <div class="name">{{ Auth::user()->name }}</div>
                    <div class="role">Administrator</div>
                </div>
                <div class="user-avatar">
                    <i class="bi bi-person-fill"></i>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content-wrapper">
            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
