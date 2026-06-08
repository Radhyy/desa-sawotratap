<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Desa Sawotratap - Menuju Digitalisasi')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&family=Playfair+Display:wght@700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="{{ asset('css/layouts.css') }}">
    @yield('styles')
    @stack('styles')

</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('home') }}">
                <img src="{{ asset('Logo/IMG_1650.GIF') }}" alt="Logo Sawotratap" class="me-2" style="width: 45px; height: 45px; object-fit: contain;">
                <div class="d-flex flex-column justify-content-center" style="color: #333;">
                    <span style="font-size: 0.6rem; letter-spacing: 2px; text-transform: uppercase; font-weight: 600; line-height: 1; margin-bottom: 2px;">Pemerintah Desa</span>
                    <span style="font-size: 1.3rem; font-weight: 800; line-height: 1; text-transform: uppercase;">SAWOTRATAP</span>
                    <span style="font-size: 0.6rem; letter-spacing: 1px; text-transform: uppercase; color: #666; font-weight: 600; line-height: 1; margin-top: 2px;">Kec. Gedangan - Kab. Sidoarjo</span>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Profil
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}">Sejarah Desa</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}#visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}#geografis">Geografis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Pemerintahan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pemerintahan.index') }}">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="{{ route('pemerintahan.index') }}#perangkat-desa">Perangkat Desa</a></li>
                            <li><a class="dropdown-item" href="{{ route('pemerintahan.index') }}#bpd">BPD</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Informasi
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#berita">Berita</a></li>
                            <li><a class="dropdown-item" href="{{ route('announcements') }}">Pengumuman</a></li>
                            <li><a class="dropdown-item" href="#galeri">Galeri</a></li>
                            <li><a class="dropdown-item" href="#">Agenda</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Layanan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('pengajuan-surat.index') }}">Pengajuan Surat</a></li>
                            <li><a class="dropdown-item" href="{{ route('pengaduan.index') }}">Pengaduan</a></li>
                            <li><a class="dropdown-item" href="{{ route('perizinan.index') }}">Perizinan</a></li>
                            <li><a class="dropdown-item" href="#umkm">UMKM</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#footer">Kontak</a>
                    </li>
                    
                    @guest
                    <!-- Login Button for Guest -->
                    <li class="nav-item ms-3">
                        <a href="{{ route('login') }}" class="btn-login">
                            <i class="bi bi-box-arrow-in-right"></i>
                            Login
                        </a>
                    </li>
                    @else
                    <!-- User Dropdown when Authenticated -->
                    <li class="nav-item dropdown ms-3">
                        <a class="nav-link dropdown-toggle nav-user-profile" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown">
                            <div class="nav-user-avatar">
                                <i class="bi bi-person-fill"></i>
                            </div>
                            <span class="nav-user-name">{{ Auth::user()->name }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            @if(Auth::user()->isAdmin())
                            <li>
                                <h6 class="dropdown-header">
                                    <i class="bi bi-shield-check text-success"></i> Admin Panel
                                </h6>
                            </li>
                            <li><a class="dropdown-item" href="{{ route('admin.dashboard') }}"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><a class="dropdown-item" href="{{ route('admin.announcements.index') }}"><i class="bi bi-megaphone me-2"></i>Kelola Pengumuman</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-newspaper me-2"></i>Kelola Berita</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-shop me-2"></i>Kelola UMKM</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-people me-2"></i>Kelola Pengguna</a></li>
                            <li><hr class="dropdown-divider"></li>
                            @endif
                            <li>
                                <a class="dropdown-item" href="{{ route('profile.index') }}"><i class="bi bi-person me-2"></i>Profil Saya</a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i>Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if(session('success'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div class="alert alert-success alert-dismissible fade show shadow-lg" role="alert" style="border-radius: 12px; border: none; border-left: 6px solid var(--primary-green, #2E7D32); background-color: white; color: #333; min-width: 300px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill fs-4 me-3" style="color: var(--primary-green, #2E7D32);"></i>
                <div class="flex-grow-1">
                    <h6 class="mb-0 fw-bold" style="color: #1a1a1a;">Berhasil!</h6>
                    <span style="font-size: 0.9rem; color: #666;">{{ session('success') }}</span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem;"></button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 9999; margin-top: 80px;">
        <div class="alert alert-danger alert-dismissible fade show shadow-lg" role="alert" style="border-radius: 12px; border: none; border-left: 6px solid #dc3545; background-color: white; color: #333; min-width: 300px;">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-triangle-fill fs-4 me-3 text-danger"></i>
                <div class="flex-grow-1">
                    <h6 class="mb-0 fw-bold" style="color: #1a1a1a;">Error!</h6>
                    <span style="font-size: 0.9rem; color: #666;">{{ session('error') }}</span>
                </div>
                <button type="button" class="btn-close ms-3" data-bs-dismiss="alert" aria-label="Close" style="font-size: 0.8rem;"></button>
            </div>
        </div>
    </div>
    @endif

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer" id="footer" style="padding-top: 0; padding-bottom: 0;">
        <div style="background-color: var(--primary-green, #2E7D32); padding: 40px 0;">
            <div class="container">
                <div class="row align-items-center">
                    <!-- Left Side: Logo & Name -->
                    <div class="col-md-6 d-flex align-items-center justify-content-center justify-content-md-start mb-4 mb-md-0">
                        <img src="{{ asset('Logo/IMG_1650.GIF') }}" alt="Logo Sawotratap" class="me-3" style="width: 80px; height: 80px; object-fit: contain;">
                        <div class="text-white text-center text-md-start">
                            <div style="font-size: 0.85rem; letter-spacing: 4px; text-transform: uppercase;">Pemerintah Desa</div>
                            <div style="font-size: 2.2rem; font-weight: 800; line-height: 1.1; margin: 5px 0;">SAWOTRATAP</div>
                            <div style="font-size: 0.85rem; letter-spacing: 2px; text-transform: uppercase;">Kec. Gedangan - Kab. Sidoarjo</div>
                        </div>
                    </div>
                    
                    <!-- Right Side: Contact Info -->
                    <div class="col-md-6 d-flex flex-column align-items-center align-items-md-end text-white">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-house-door-fill me-3" style="font-size: 1.3rem;"></i>
                            <span style="font-size: 1rem; font-weight: 500;">Jl. Raya Sawotratap No. 123, Gedangan, Sidoarjo</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-mouse3-fill me-3" style="font-size: 1.3rem;"></i>
                            <a href="https://sawotratap.desa.id" class="text-white text-decoration-none" style="font-size: 1rem; font-weight: 500;">https://sawotratap.desa.id</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Bottom Copyright Band -->
        <div style="background-color: rgba(0, 0, 0, 0.15); padding: 15px 0;">
            <div class="container text-center text-white" style="font-size: 0.85rem; font-weight: 500;">
                &copy; {{ date('Y') }} Pemerintah Desa Sawotratap. Hak cipta dilindungi undang-undang. Jejaring Desa Daring Sidoarjo.
            </div>
        </div>
        
        <!-- Back to Top Button -->
        <a href="#home" class="back-to-top">
            <i class="bi bi-arrow-up"></i>
        </a>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Shiny Button Mouse Tracking
        document.addEventListener('DOMContentLoaded', function() {
            const shinyButtons = document.querySelectorAll('.shiny-button');
            
            shinyButtons.forEach(button => {
                button.addEventListener('mousemove', function(e) {
                    const rect = button.getBoundingClientRect();
                    const x = e.clientX - rect.left;
                    const y = e.clientY - rect.top;
                    
                    button.style.setProperty('--mouse-x', `${x}px`);
                    button.style.setProperty('--mouse-y', `${y}px`);
                });
            });

            // Counter Animation for Stats
            function animateCounter(element) {
                const target = parseInt(element.getAttribute('data-target'));
                const duration = 2000;
                const increment = target / (duration / 16);
                let current = 0;

                const updateCounter = () => {
                    current += increment;
                    if (current < target) {
                        element.textContent = Math.floor(current).toLocaleString();
                        requestAnimationFrame(updateCounter);
                    } else {
                        element.textContent = target.toLocaleString();
                    }
                };

                updateCounter();
            }

            // Intersection Observer for Counter Animation
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                        entry.target.classList.add('counted');
                        animateCounter(entry.target);
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stat-number-premium[data-target]').forEach(counter => {
                observer.observe(counter);
            });

            // 3D Tilt Effect for Image Card - Simplified
            const imageCard = document.querySelector('.hero-image-card');
            if (imageCard) {
                // Removed 3D tilt effect for simpler hover
            }

            // Magic Buttons Interactive Effects
            const magicButtons = document.querySelectorAll('.magic-button');
            magicButtons.forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                });
            });

            // Navbar Scroll Effect
            const navbar = document.querySelector('.navbar');
            let lastScroll = 0;

            window.addEventListener('scroll', function() {
                const currentScroll = window.pageYOffset;
                
                if (currentScroll > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }
                
                lastScroll = currentScroll;
            });

            // Smooth Dropdown Animation
            const dropdownElements = document.querySelectorAll('.dropdown-toggle');
            dropdownElements.forEach(dropdown => {
                dropdown.addEventListener('show.bs.dropdown', function() {
                    const menu = this.nextElementSibling;
                    if (menu) {
                        menu.style.animation = 'dropdownSlide 0.3s ease';
                    }
                });
            });

            // Back to Top Button
            const backToTop = document.querySelector('.back-to-top');
            
            window.addEventListener('scroll', function() {
                if (window.pageYOffset > 300) {
                    backToTop.classList.add('show');
                } else {
                    backToTop.classList.remove('show');
                }
            });

            // Smooth scroll for back to top
            backToTop.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
    @stack('scripts')
</body>
</html>
