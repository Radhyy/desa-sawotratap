<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Kades Panel - Desa Sawotratap')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        :root {
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --sidebar-bg: #152c0a; /* Sama persis dengan admin */
            --sidebar-hover: rgba(255, 255, 255, 0.08);
            --sidebar-active: #2d5016;
            --text-muted: #9ca3af;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: #f4f6f9;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: var(--sidebar-bg);
            color: #d1d5db;
            padding: 0;
            overflow-y: auto;
            overflow-x: hidden;
            z-index: 1000;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 4px 0 15px rgba(0,0,0,0.05);
        }

        .admin-sidebar::-webkit-scrollbar { width: 6px; }
        .admin-sidebar::-webkit-scrollbar-track { background: transparent; }
        .admin-sidebar::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.2); border-radius: 3px; }

        .admin-sidebar.collapsed { width: var(--sidebar-collapsed-width); }

        .sidebar-header {
            padding: 0 1.5rem;
            border-bottom: 1px solid rgba(255,255,255,0.05);
            background: #0f2107;
            height: 80px;
            display: flex;
            align-items: center;
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            gap: 1rem;
            text-decoration: none;
            color: white;
            width: 100%;
            white-space: nowrap;
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-brand-text { line-height: 1; }
        .sidebar-brand-text .brand-sub {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
            color: rgba(255,255,255,0.65);
            margin-bottom: 2px;
        }
        .sidebar-brand-text .brand-name {
            display: block;
            font-family: 'Sora', sans-serif;
            font-weight: 800;
            font-size: 1.05rem;
            text-transform: uppercase;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 2px;
        }
        .sidebar-brand-text .brand-loc {
            display: block;
            font-size: 0.6rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            font-weight: 500;
            color: rgba(255,255,255,0.55);
        }

        .sidebar-menu { padding: 1.5rem 1rem; }

        .menu-section-title {
            padding: 1rem 0.5rem 0.5rem;
            font-size: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            font-weight: 600;
            white-space: nowrap;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 0.85rem 1rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.2s ease;
            position: relative;
            border-radius: 10px;
            margin-bottom: 0.25rem;
            white-space: nowrap;
        }
        .menu-item i { font-size: 1.25rem; width: 30px; text-align: center; margin-right: 12px; flex-shrink: 0; }
        .menu-item:hover { background: var(--sidebar-hover); color: white; }
        .menu-item.active { background: var(--sidebar-active); color: white; }

        /* Collapsed state */
        .admin-sidebar.collapsed .sidebar-header { padding: 0; justify-content: center; }
        .admin-sidebar.collapsed .sidebar-brand { justify-content: center; gap: 0; }
        .admin-sidebar.collapsed .sidebar-brand-text,
        .admin-sidebar.collapsed .menu-section-title,
        .admin-sidebar.collapsed .menu-item span { display: none; }
        .admin-sidebar.collapsed .menu-item { justify-content: center; padding: 1rem 0; }
        .admin-sidebar.collapsed .menu-item i { margin-right: 0; }

        /* Main Content */
        .admin-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
            padding: 0;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .admin-content.expanded { margin-left: var(--sidebar-collapsed-width); }

        .admin-topbar {
            background: white;
            height: 80px;
            padding: 0 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.02);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-left { display: flex; align-items: center; gap: 1.5rem; }

        .toggle-sidebar-btn {
            background: transparent;
            border: none;
            font-size: 1.5rem;
            color: #4b5563;
            cursor: pointer;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transition: all 0.2s;
        }
        .toggle-sidebar-btn:hover { background: #f3f4f6; color: #111827; }

        .topbar-title h4 {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #111827;
            font-size: 1.25rem;
        }
        .topbar-title p { margin: 0; font-size: 0.85rem; color: #6b7280; }

        .topbar-user { display: flex; align-items: center; gap: 1rem; }
        .user-info { text-align: right; }
        .user-info .name { font-weight: 600; color: #111827; font-size: 0.95rem; }
        .user-info .role { font-size: 0.75rem; color: #6b7280; }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: var(--sidebar-active);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
            font-weight: bold;
        }

        .content-wrapper { padding: 2rem; }

        /* Cards */
        .admin-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .card-header-custom {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #f3f4f6;
        }
        .card-header-custom h5 {
            margin: 0;
            font-family: 'Sora', sans-serif;
            font-weight: 700;
            color: #111827;
            font-size: 1.1rem;
        }

        /* Pagination */
        .pagination { gap: 4px; margin: 0; }
        .pagination .page-item .page-link {
            border: 1.5px solid #e5e7eb;
            color: #374151;
            border-radius: 8px !important;
            padding: 6px 13px;
            font-weight: 600;
            font-size: 0.85rem;
            background: #fff;
            transition: all 0.18s;
            box-shadow: none;
        }
        .pagination .page-item .page-link:hover { background: #f0fdf4; border-color: #2d5016; color: #2d5016; }
        .pagination .page-item.active .page-link { background: #2d5016; border-color: #2d5016; color: #fff; box-shadow: 0 2px 8px rgba(45,80,22,0.25); }
        .pagination .page-item.disabled .page-link { background: #f9fafb; border-color: #f3f4f6; color: #d1d5db; pointer-events: none; }
        nav[role="navigation"] > div:first-child { font-size: 0.82rem; color: #9ca3af; }

        /* Responsive */
        @media (max-width: 768px) {
            .admin-sidebar { transform: translateX(-100%); }
            .admin-sidebar.mobile-open { transform: translateX(0); width: var(--sidebar-width); }
            .admin-content { margin-left: 0 !important; }
            .topbar-title p, .topbar-user .user-info { display: none; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- Sidebar -->
    <div class="admin-sidebar" id="sidebar">
        <!-- Sidebar Header -->
        <div class="sidebar-header">
            <a href="{{ route('home') }}" class="sidebar-brand">
                <div class="sidebar-brand-icon" style="background: transparent; width: 44px; height: 44px; border-radius: 0;">
                    <img src="{{ asset('Logo/IMG_1650.GIF') }}" alt="Logo Sawotratap" style="width: 44px; height: 44px; object-fit: contain;">
                </div>
                <div class="sidebar-brand-text">
                    <span class="brand-sub">Kepala Desa</span>
                    <span class="brand-name">Sawotratap</span>
                    <span class="brand-loc">Gedangan &ndash; Sidoarjo</span>
                </div>
            </a>
        </div>

        <!-- Sidebar Menu - Kades only sees relevant items -->
        <div class="sidebar-menu">
            <div class="menu-section-title">Main Menu</div>
            <a href="{{ route('kades.dashboard') }}" class="menu-item {{ request()->routeIs('kades.dashboard') ? 'active' : '' }}" title="Dashboard">
                <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span>
            </a>

            <div class="menu-section-title">Persetujuan & Disposisi</div>
            <a href="{{ route('kades.pengajuan-surat.index') }}" class="menu-item {{ request()->routeIs('kades.pengajuan-surat.*') ? 'active' : '' }}" title="Pengajuan Surat">
                <i class="bi bi-envelope-paper-fill"></i> <span>Pengajuan Surat</span>
            </a>
            <a href="{{ route('kades.pengaduan.index') }}" class="menu-item {{ request()->routeIs('kades.pengaduan.*') ? 'active' : '' }}" title="Pengaduan Warga">
                <i class="bi bi-chat-left-text-fill"></i> <span>Pengaduan Warga</span>
            </a>
            <a href="{{ route('kades.perizinan.index') }}" class="menu-item {{ request()->routeIs('kades.perizinan.*') ? 'active' : '' }}" title="Perizinan Warga">
                <i class="bi bi-file-earmark-check-fill"></i> <span>Perizinan Warga</span>
            </a>

            <div class="menu-section-title">Akun</div>
            <a href="{{ route('home') }}" class="menu-item" title="Kembali ke Website">
                <i class="bi bi-arrow-left-circle-fill"></i> <span>Lihat Website</span>
            </a>
            <a href="#" class="menu-item" onclick="event.preventDefault(); document.getElementById('logout-form-kades').submit();" title="Logout">
                <i class="bi bi-box-arrow-right"></i> <span>Logout</span>
            </a>
        </div>
    </div>

    <!-- Main Content -->
    <div class="admin-content" id="main-content">
        <!-- Topbar -->
        <div class="admin-topbar">
            <div class="topbar-left">
                <button class="toggle-sidebar-btn" id="toggle-btn">
                    <i class="bi bi-list"></i>
                </button>
                <div class="topbar-title">
                    <h4>@yield('page-title', 'Dashboard')</h4>
                    <p>@yield('page-description', 'Panel Kepala Desa Sawotratap')</p>
                </div>
            </div>

            <div class="topbar-user">
                <div class="user-info">
                    <div class="name">{{ Auth::user()->name ?? 'Kepala Desa' }}</div>
                    <div class="role">Kepala Desa</div>
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
            <div class="alert alert-success alert-dismissible fade show" style="border-radius: 12px;" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                <strong>Berhasil!</strong> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" style="border-radius: 12px;" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Error!</strong> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </div>

    <!-- Logout Form -->
    <form id="logout-form-kades" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('main-content');
            const toggleBtn = document.getElementById('toggle-btn');

            toggleBtn.addEventListener('click', function() {
                if (window.innerWidth <= 768) {
                    sidebar.classList.toggle('mobile-open');
                } else {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                }
            });

            document.addEventListener('click', function(event) {
                if (window.innerWidth <= 768) {
                    if (!sidebar.contains(event.target) && !toggleBtn.contains(event.target)) {
                        sidebar.classList.remove('mobile-open');
                    }
                }
            });
        });

        // SweetAlert2 Global Confirmation function
        function confirmAction(event, message) {
            event.preventDefault();
            const button = event.currentTarget;
            const form = button.closest('form');
            
            Swal.fire({
                title: 'Konfirmasi',
                text: message,
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#2d5016',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Lanjutkan',
                cancelButtonText: 'Batal',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    if (button.name && button.value) {
                        const hiddenInput = document.createElement('input');
                        hiddenInput.type = 'hidden';
                        hiddenInput.name = button.name;
                        hiddenInput.value = button.value;
                        form.appendChild(hiddenInput);
                    }
                    form.submit();
                }
            });
        }
    </script>
    @stack('scripts')
</body>
</html>
