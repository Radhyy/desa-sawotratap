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
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
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
                <img src="{{ asset('Logo/Seal_of_Sidoarjo_Regency.svg.png') }}" alt="Logo Sidoarjo" class="me-2" style="width: 40px; height: 40px; object-fit: contain;">
                <div>
                    <div class="fw-bold" style="font-size: 1.1rem; line-height: 1.2;">Sawotratap</div>
                    <small style="font-size: 0.75rem; color: #666;">Gedangan, Sidoarjo</small>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Profil
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}#sejarah">Sejarah Desa</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}#visi-misi">Visi & Misi</a></li>
                            <li><a class="dropdown-item" href="{{ route('profile-desa.index') }}#geografis">Geografis</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
                            Pemerintahan
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Struktur Organisasi</a></li>
                            <li><a class="dropdown-item" href="#">Perangkat Desa</a></li>
                            <li><a class="dropdown-item" href="#">BPD</a></li>
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
                            <li><a class="dropdown-item" href="#">Pengaduan</a></li>
                            <li><a class="dropdown-item" href="#">Perizinan</a></li>
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
                        <a class="nav-link dropdown-toggle d-flex align-items-center user-dropdown" 
                           href="#" 
                           role="button" 
                           data-bs-toggle="dropdown"
                           style="color: var(--primary-green); font-weight: 600;">
                            <div class="user-avatar me-2">
                                <i class="bi bi-person-circle"></i>
                            </div>
                            {{ Auth::user()->name }}
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
    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin: 90px 20px 0 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div class="container">
            <i class="bi bi-check-circle-fill me-2"></i>
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin: 90px 20px 0 20px; border-radius: 12px; box-shadow: 0 4px 15px rgba(0,0,0,0.1);">
        <div class="container">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>
            <strong>Error!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Content -->
    @yield('content')

    <!-- Footer -->
    <footer class="footer" id="footer">
        <div class="footer-wave">
            <svg viewBox="0 0 1200 120" preserveAspectRatio="none">
                <path d="M321.39,56.44c58-10.79,114.16-30.13,172-41.86,82.39-16.72,168.19-17.73,250.45-.39C823.78,31,906.67,72,985.66,92.83c70.05,18.48,146.53,26.09,214.34,3V0H0V27.35A600.21,600.21,0,0,0,321.39,56.44Z"></path>
            </svg>
        </div>
        
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-brand mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="/Logo/logo pemda.png" alt="Logo" class="footer-logo me-3">
                            <div>
                                <h4 class="mb-0 fw-bold">Sawotratap</h4>
                                <p class="mb-0 small">Gedangan, Sidoarjo</p>
                            </div>
                        </div>
                    </div>
                    <p class="footer-desc mb-4">Desa yang terus berkembang menuju digitalisasi dengan tetap menjaga nilai-nilai budaya lokal dan kearifan tradisional.</p>
                    
                    <div class="footer-contact mb-4">
                        <div class="contact-item mb-2">
                            <i class="bi bi-geo-alt-fill me-2"></i>
                            <span>Jl. Raya Sawotratap No. 123, Gedangan, Sidoarjo</span>
                        </div>
                        <div class="contact-item mb-2">
                            <i class="bi bi-telephone-fill me-2"></i>
                            <span>(031) 1234567</span>
                        </div>
                        <div class="contact-item">
                            <i class="bi bi-envelope-fill me-2"></i>
                            <span>info@sawotratap.desa.id</span>
                        </div>
                    </div>
                    
                    <div class="social-links">
                        <a href="#" class="social-link" title="Facebook">
                            <i class="bi bi-facebook"></i>
                        </a>
                        <a href="#" class="social-link" title="Instagram">
                            <i class="bi bi-instagram"></i>
                        </a>
                        <a href="#" class="social-link" title="Twitter">
                            <i class="bi bi-twitter"></i>
                        </a>
                        <a href="#" class="social-link" title="YouTube">
                            <i class="bi bi-youtube"></i>
                        </a>
                    </div>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title mb-4">Profil Desa</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Sejarah</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Visi Misi</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Struktur</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Demografi</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title mb-4">Layanan</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Surat</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Pengaduan</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Perizinan</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Bantuan</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title mb-4">Informasi</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Berita</a></li>
                        <li><a href="{{ route('announcements') }}"><i class="bi bi-chevron-right me-2"></i>Pengumuman</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Agenda</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>UMKM</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Galeri</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title mb-4">Lainnya</h5>
                    <ul class="footer-links">
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>APBDes</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Peta Desa</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>Kontak</a></li>
                        <li><a href="#"><i class="bi bi-chevron-right me-2"></i>FAQ</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <div class="row align-items-center">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        <p class="mb-0">&copy; {{ date('Y') }} <strong>Desa Sawotratap</strong>. All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <p class="mb-0">Made with <i class="bi bi-heart-fill text-danger"></i> for the Community</p>
                    </div>
                </div>
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
