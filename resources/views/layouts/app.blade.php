<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'SMKN 4 BOGOR')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        :root {
            --primary-color: #1e3a8a;
            --secondary-color: #ffffff;
            --accent-color: #dc2626;    
            --dark-bg: #0f172a;
            --light-bg: #f8fafc;
            --card-bg: #ffffff;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
            --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        /* Top Information Bar - Netflix Style */
        .top-info-bar {
            background: linear-gradient(135deg, var(--dark-bg) 0%, #1e293b 100%);
            color: var(--secondary-color);
            padding: 12px 0;
            font-size: 14px;
            font-weight: 500;
            box-shadow: var(--shadow-lg);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(0);
            opacity: 1;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .top-info-bar.hidden {
            transform: translateY(-100%);
            opacity: 0;
        }
        
        .top-info-bar .contact-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .top-info-bar .contact-info i {
            color: var(--secondary-color);
            margin-right: 5px;
        }
        
        .top-info-bar .social-media {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .top-info-bar .social-media a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease;
        }
        
        .top-info-bar .social-media a:hover {
            color: var(--secondary-color);
        }
        
        /* Main Navigation Bar - Modern Professional Style */
        .main-navbar {
            background: rgba(255, 255, 255, 0.95);
            padding: 0.5rem 0;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            position: sticky;
            top: 0;
            z-index: 999;
            transition: all 0.3s ease;
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(226, 232, 240, 0.6);
        }
        
        .main-navbar .container-fluid {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0.5rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }
        
        .main-navbar.with-topbar {
            margin-top: 30px;
        }
        
        .navbar-brand {
            background: transparent;
            color: var(--text-primary) !important;
            padding: 12px 20px;
            margin: 0;
            border-radius: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            position: relative;
            z-index: 10;
            font-weight: 700;
            font-size: 18px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .navbar-brand:hover {
            background: rgba(30, 58, 138, 0.05);
            transform: translateY(-1px);
        }
        
        .navbar-brand img {
            height: 40px;
            width: auto;
        }
        
        .navbar-brand .school-name {
            transform: none;
        }
        
        .navbar-brand .school-name h4 {
            margin: 0;
            font-size: 12px;
            color: #64748b;
            font-weight: 500;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand .school-name h3 {
            margin: 0;
            font-size: 18px;
            color: var(--primary-color);
            font-weight: 600;
            letter-spacing: 0.5px;
        }
        
        .nav-link {
            color: var(--text-primary) !important;
            font-weight: 600;
            font-size: 14px;
            padding: 12px 20px !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            border-radius: 10px !important;
            border: none !important;
            letter-spacing: 0.3px;
            text-transform: uppercase;
            background: transparent;
            margin: 0 4px;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
            background: rgba(30, 58, 138, 0.08);
            transform: translateY(-2px);
        }
        
        .nav-link.active {
            color: white !important;
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            font-weight: 700;
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
        }
        
        .nav-link.active::after {
            display: none;
        }
        
        
        .logout-btn {
            background: none;
            border: none;
            color: #6b7280;
            font-size: 14px;
            padding: 10px 16px;
            transition: all 0.2s ease;
            border-radius: 10px !important;
        }
        
        .logout-btn:hover {
            color: var(--primary-color);
            background-color: rgba(30, 58, 138, 0.08);
            transform: translateX(4px);
        }
        
        .hero-section {
            background: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), 
                        url('/images/hero-bg.jpg') center/cover;
            min-height: 500px;
            display: flex;
            align-items: center;
            color: white;
        }
        
        .footer {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            color: white;
            padding: 3rem 0 1.5rem;
            margin-top: 4rem;
            border-radius: 32px 32px 0 0;
            position: relative;
            overflow: hidden;
        }
        
        .footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), #3b82f6, #8b5cf6);
        }
        
        .footer h5 {
            font-weight: 700;
            margin-bottom: 1rem;
            color: white;
        }
        
        .footer p {
            color: rgba(255, 255, 255, 0.8);
            line-height: 1.6;
        }
        
        /* Alert Messages Rounded */
        .alert {
            border-radius: 12px !important;
            border: none;
            padding: 16px 20px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }
        
        .alert-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
            color: white;
        }
        
        .alert-info {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            border: none;
            border-radius: 12px !important;
            font-weight: 600;
            padding: 12px 28px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 12px rgba(30, 58, 138, 0.3);
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #1e40af 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(30, 58, 138, 0.4);
        }
        
        .btn-outline-primary {
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            background: transparent;
            border-radius: 12px !important;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .btn-outline-primary:hover {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }
        
        /* Form Controls - Modern Style */
        .form-control {
            border: 2px solid var(--border-color);
            border-radius: 12px !important;
            padding: 14px 18px;
            font-size: 14px;
            transition: all 0.3s ease;
            background: var(--card-bg);
        }
        
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 4px rgba(30, 58, 138, 0.1);
            background: var(--card-bg);
            transform: translateY(-1px);
        }
        
        /* Dropdown Menu Rounded */
        .dropdown-menu {
            border-radius: 16px !important;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
            padding: 8px;
            margin-top: 8px !important;
        }
        
        .dropdown-item {
            border-radius: 10px !important;
            padding: 10px 16px;
            margin: 2px 0;
            transition: all 0.2s ease;
        }
        
        .dropdown-item:hover {
            background: rgba(30, 58, 138, 0.08);
            color: var(--primary-color);
            transform: translateX(4px);
        }
        
        .dropdown-divider {
            margin: 8px 0;
            opacity: 0.1;
        }
        
        .form-label {
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
        }
        
        /* Rounded Elements - Professional Style */
        .rounded-circle { 
            border-radius: 50% !important; 
        }
        
        .card {
            border-radius: 16px !important;
            border: none;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        
        .card:hover {
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            transform: translateY(-2px);
        }
        
        .card-header {
            border-radius: 16px 16px 0 0 !important;
            border-bottom: none;
        }
        
        .card-body {
            border-radius: 0 0 16px 16px !important;
        }
        
        /* Minimalist Gen Z Design Enhancements */
        .navbar {
            border: none !important;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .navbar-nav .nav-item {
            border-radius: 0 !important;
        }
        
        .navbar-toggler {
            border-radius: 10px !important;
            border: 2px solid var(--border-color);
            box-shadow: none;
            padding: 8px 12px;
            transition: all 0.3s ease;
        }
        
        .navbar-toggler:hover {
            background: rgba(30, 58, 138, 0.05);
            border-color: var(--primary-color);
        }
        
        .navbar-toggler:focus {
            box-shadow: 0 0 0 3px rgba(30, 58, 138, 0.1);
        }
        
        /* Gen Z Minimalist color scheme */
        .top-info-bar {
            background-color: #0f172a !important;
        }
        
        .main-navbar {
            background-color: #f8fafc !important;
        }
        
        /* Page Transition Animations */
        .page-transition {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.6s ease-in-out;
        }
        
        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Section Animation */
        .section-fade-in {
            opacity: 1;
            transform: translateY(0);
            transition: all 0.8s ease-in-out;
        }
        
        .section-fade-in.visible {
            opacity: 1;
            transform: translateY(0);
        }
        
        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }
        
        /* Ensure content is visible */
        main {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
        }
        
        section {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
        }
        
        .container {
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .row {
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        .card {
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        /* Card hover animations - Netflix Style */
        .card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            border-radius: 12px !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-8px) scale(1.02);
            box-shadow: var(--shadow-xl);
            border-color: var(--primary-color);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%);
            color: var(--secondary-color);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }
        
        .card-body {
            padding: 24px;
        }
        
        /* Force visibility for all content */
        * {
            opacity: 1 !important;
            visibility: visible !important;
        }
        
        /* Override any hidden elements */
        .hidden, .d-none, [style*="display: none"], [style*="opacity: 0"] {
            opacity: 1 !important;
            visibility: visible !important;
            display: block !important;
        }
        
        /* Button animations */
        .btn {
            transition: all 0.3s ease;
        }
        
        .btn:hover {
            transform: translateY(-2px);
        }
        
        /* Navbar link animations - Netflix Style */
        .nav-link {
            position: relative;
            overflow: hidden;
        }
        
        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .nav-link:hover::before {
            left: 100%;
        }
        
        /* Modern animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Footer minimalist overrides */
        .footer {
            padding: 1.5rem 0;
        }
        .footer .card {
            background: transparent;
            border: 0;
            box-shadow: none;
        }
        .footer .card-header {
            background: transparent;
            color: #e2e8f0;
            border: 0;
            padding: .5rem 1rem;
        }
        .footer .card-header h5 {
            font-size: 1rem;
            margin: 0;
            letter-spacing: .3px;
        }
        .footer .card-body {
            padding: 1rem 1rem 1.25rem;
        }
        .footer .map-container {
            height: 260px !important;
        }
        .footer h5 { font-size: 1rem; }
        .footer p { color: #cbd5e1; margin-bottom: .25rem; }
        .footer label { color: #cbd5e1; font-size: .9rem; }
        .footer .form-control {
            background: rgba(255,255,255,0.06);
            border-color: rgba(255,255,255,0.15);
            color: #e5e7eb;
        }
        .footer .form-control::placeholder { color: #94a3b8; }
        .footer .form-control:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59,130,246,0.2);
            background: rgba(255,255,255,0.08);
        }
        .footer .btn-primary { padding: 8px 16px; border-radius: 6px !important; }
        
        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }
        
        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }
        
        .animate-fadeInUp {
            animation: fadeInUp 0.8s ease-out;
        }
        
        .animate-slideInLeft {
            animation: slideInLeft 0.6s ease-out;
        }
        
        .animate-pulse {
            animation: pulse 2s infinite;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .top-info-bar .contact-info,
            .top-info-bar .social-media {
                justify-content: center;
                margin: 5px 0;
            }
            
            .navbar-brand {
                transform: none;
                border-radius: 12px !important;
                margin: 0 auto;
            }
            
            .navbar-brand .school-name {
                transform: none;
            }
            
            .nav-link {
                border-radius: 10px !important;
                text-align: center;
                margin: 4px 0;
            }
            
            .main-navbar .container-fluid {
                border-radius: 12px;
                padding: 1rem;
            }
            
            .navbar-collapse {
                margin-top: 1rem;
            }
        }
    </style>
</head>
<body>
    <!-- Top Information Bar -->

    <!-- Main Navigation Bar -->
    <nav class="navbar navbar-expand-lg main-navbar">
    <div class="container-fluid">

        {{-- Logo + Nama Sekolah --}}
        <a class="navbar-brand d-flex align-items-center" href="{{ route('guest.home') }}">
            <img src="/images/logo-smkn4.png.png" alt="SMKN 4 BOGOR" style="height:50px; margin-right:10px;">
            <span class="fw-bold">SMKN 4 BOGOR</span>
        </a>

        {{-- Toggle untuk mode mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        {{-- Menu --}}
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">

                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('guest.profil') ? 'active' : '' }}" href="{{ route('guest.profil') }}">PROFIL</a>
                </li>

                <li class="nav-item ms-3">
                    <a class="nav-link {{ request()->routeIs('guest.agenda*') ? 'active' : '' }}" href="{{ route('guest.agenda') }}">AGENDA</a>
                </li>

                <li class="nav-item ms-3">
                    <a class="nav-link {{ request()->routeIs('guest.informasi*') ? 'active' : '' }}" href="{{ route('guest.informasi') }}">INFORMASI</a>
                </li>

                <li class="nav-item ms-3">
                    <a class="nav-link {{ request()->routeIs('guest.galeri*') ? 'active' : '' }}" href="{{ route('guest.galeri') }}">GALERI</a>
                </li>

                <!-- KONTAK menu dihapus; kontak dipindah ke footer -->

                {{-- Auth area kanan: Guest => tombol Masuk/Daftar; User login => dropdown akun --}}
                @php($userAuth = auth('user'))
                @if($userAuth->check())
                    <li class="nav-item dropdown ms-4">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            @php($u = $userAuth->user())
                            @if($u && $u->profile_photo_path)
                                <img src="{{ asset('storage/'.$u->profile_photo_path) }}?v={{ $u?->updated_at?->timestamp ?? time() }}" alt="avatar" class="rounded-circle me-2" style="width:32px;height:32px;object-fit:cover;">
                            @else
                                <span class="me-2 rounded-circle d-inline-flex justify-content-center align-items-center" style="width:32px;height:32px;background:#e2e8f0;color:#64748b;font-weight:700;">{{ strtoupper(substr($u?->name ?? 'U',0,1)) }}</span>
                            @endif
                            <span>{{ $u?->username ?? $u?->name ?? 'Akun' }}</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="{{ route('user.profile') }}"><i class="fa-regular fa-user me-2"></i>Profil</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('user.logout') }}">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-right-from-bracket me-2"></i>Keluar</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item ms-3">
                        <a class="btn btn-outline-primary" href="{{ route('user.login') }}">Masuk</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a class="btn btn-primary" href="{{ route('user.register') }}">Daftar</a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>


    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Smooth Scrolling Script -->
    @php($__flash = session()->only(['success','error','warning','info']))
    <script>
        // SweetAlert toast for session messages
        (function(){
            const msgTypes = ['success','error','warning','info'];
            let shown = false;
            const el = {!! json_encode($__flash, JSON_HEX_TAG|JSON_HEX_APOS|JSON_HEX_QUOT|JSON_HEX_AMP) !!};
            msgTypes.forEach(function(t){
                if (!shown && el && el[t]) {
                    shown = true;
                    if (window.Swal) {
                        Swal.fire({
                            toast: true,
                            position: 'top-end',
                            icon: t,
                            title: el[t],
                            showConfirmButton: false,
                            timer: 2000,
                            timerProgressBar: true
                        });
                    }
                }
            });
        })();
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Smooth scrolling for anchor links
            const navLinks = document.querySelectorAll('a[href*="#"]');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    
                    // Only handle internal anchor links
                    if (href.startsWith('#') || href.includes('#')) {
                        e.preventDefault();
                        
                        const targetId = href.split('#')[1];
                        const targetElement = document.getElementById(targetId);
                        
                        if (targetElement) {
                            targetElement.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
            
            // Update active nav link based on scroll position (only on home page)
            const sections = document.querySelectorAll('section[id]');
            const navItems = document.querySelectorAll('.nav-link');
            
            function updateActiveNav() {
                let current = '';
                
                sections.forEach(section => {
                    const sectionTop = section.offsetTop;
                    const sectionHeight = section.clientHeight;
                    
                    if (window.pageYOffset >= (sectionTop - 200)) {
                        current = section.getAttribute('id');
                    }
                });
                
                // Update active state for navbar items
                navItems.forEach(item => {
                    item.classList.remove('active');
                    
                    // Check if this nav item corresponds to current section
                    if (current === 'profil' && item.textContent.trim() === 'PROFIL') {
                        item.classList.add('active');
                    } else if (current === 'galeri' && item.textContent.trim() === 'GALERI') {
                        item.classList.add('active');
                    } else if (current === 'beranda' && item.textContent.trim() === 'BERANDA') {
                        item.classList.add('active');
                    }
                });
            }
            
            // Only run scroll detection on home page
            if (window.location.pathname === '/' || window.location.pathname === '') {
                window.addEventListener('scroll', updateActiveNav);
                updateActiveNav(); // Call once on load
            }
            
            // Pastikan konten utama terlihat (tanpa mengganggu komponen Bootstrap)
            const mainContent = document.querySelector('main');
            if (mainContent) {
                mainContent.style.opacity = '1';
                mainContent.style.visibility = 'visible';
            }
            
            // HINDARI memaksa semua elemen menjadi terlihat karena dapat mengganggu .modal/.dropdown
            // Jika ingin memastikan elemen tertentu muncul, targetkan selektor yang aman saja.
        });
    </script>

    <!-- Footer -->
    <footer class="footer mt-3">
        <div class="container">
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>SMK Negeri 4 Kota Bogor</h5>
                    <p>Jl. Raya Tajur No. 33, Bogor<br>
                    Jawa Barat, Indonesia</p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5>Kontak</h5>
                    <p>Email: info@smkn4bogor.sch.id<br>
                    Telp: (0251) 123456</p>
                </div>
            </div>

            <!-- Peta Lokasi & Kirim Pesan di Footer -->
            <div class="row g-3 align-items-stretch">
                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg h-100" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header text-white" style="background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%); border-radius: 20px 20px 0 0;">
                            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i>Denah Lokasi</h5>
                        </div>
                        <div class="card-body p-0">
                            <div class="map-container" style="overflow: hidden; border-radius: 0 0 20px 20px;">
                                <iframe 
                                    src="https://www.google.com/maps?q=Jl.+Raya+Tajur,+Kp.+Buntar+RT.02/RW.08,+Kel.+Muara+sari,+Kec.+Bogor+Selatan,+RT.03/RW.08,+Muarasari,+Kec.+Bogor+Sel.,+Kota+Bogor,+Jawa+Barat+16137&output=embed" 
                                    width="100%" 
                                    height="100%" 
                                    style="border:0;" 
                                    allowfullscreen="" 
                                    loading="lazy" 
                                    referrerpolicy="no-referrer-when-downgrade"></iframe>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card border-0 shadow-lg h-100" style="border-radius: 20px; overflow: hidden;">
                        <div class="card-header text-white text-center" style="background: linear-gradient(135deg, var(--primary-color) 0%, #3b82f6 100%); border-radius: 20px 20px 0 0;">
                            <h5 class="mb-0"><i class="fas fa-paper-plane me-2"></i>Kirim Pesan</h5>
                        </div>
                        <div class="card-body p-4" style="border-radius: 0 0 20px 20px;">
                            @php($userAuth = auth('user'))
                            <form id="footerMessageForm">
                                @csrf
                                <div class="mb-3">
                                    <label for="footer_pesan" class="form-label">Pesan</label>
                                    <textarea class="form-control" id="footer_pesan" name="pesan" rows="4" placeholder="Tuliskan pesan Anda" @if(!$userAuth->check()) disabled @else required @endif></textarea>
                                </div>
                                <div class="text-center">
                                    @if(!$userAuth->check())
                                        <a href="{{ route('user.login') }}" class="btn btn-primary px-4" id="footerSubmitBtn">
                                            <i class="fas fa-right-to-bracket me-2"></i>Masuk
                                        </a>
                                    @else
                                        <button type="submit" class="btn btn-primary px-4" id="footerSubmitBtn">
                                            <i class="fas fa-paper-plane me-2"></i>Kirim
                                        </button>
                                    @endif
                                </div>
                            </form>
                            <div id="footerAlertContainer" class="mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>

            <hr class="my-3">
            <div class="text-center">
                <p>&copy; {{ date('Y') }} SMKN 4 BOGOR. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 for notifications -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <!-- Scroll Effect Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const topInfoBar = document.querySelector('.top-info-bar');
            const mainNavbar = document.querySelector('.main-navbar');
            let lastScrollTop = 0;
            let ticking = false;
            
            function updateNavbar() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                
                // Jalankan hanya jika elemen tersedia (hindari error JS)
                if (topInfoBar && mainNavbar) {
                    // Tampilkan top bar saat di paling atas
                    if (scrollTop === 0) {
                        topInfoBar.classList.remove('hidden');
                        mainNavbar.classList.add('with-topbar');
                    } else {
                        // Sembunyikan saat scroll turun
                        topInfoBar.classList.add('hidden');
                        mainNavbar.classList.remove('with-topbar');
                    }
                }
                
                lastScrollTop = scrollTop;
                ticking = false;
            }
            
            function requestTick() {
                if (!ticking) {
                    requestAnimationFrame(updateNavbar);
                    ticking = true;
                }
            }
            
            // Daftarkan listener hanya jika salah satu elemen ada
            if (topInfoBar || mainNavbar) {
                window.addEventListener('scroll', requestTick, { passive: true });
            }
            
            // Inisialisasi state navbar bila elemen ada
            if (topInfoBar && mainNavbar) {
                topInfoBar.classList.remove('hidden');
                mainNavbar.classList.add('with-topbar');
            }
        });
    </script>
    
    
    @stack('scripts')
    
    <!-- Force content visibility script -->
    <script>
        // Jalankan setelah halaman selesai dimuat
        window.addEventListener('load', function() {
            // JANGAN memaksa semua elemen tampil. Batasi agar tidak menyentuh modal/backdrop/offcanvas/dropdown.
            const unsafeSelectors = ['.modal', '.modal-backdrop', '.offcanvas', '.dropdown-menu'];
            // Contoh perapian ringan untuk konten utama saja
            const main = document.querySelector('main');
            if (main) {
                main.style.opacity = '1';
                main.style.visibility = 'visible';
            }
            
            console.log('Konten utama ditampilkan tanpa mengganggu komponen Bootstrap');
        });
        
        // Jalankan segera (aman), tanpa menyentuh komponen interaktif Bootstrap
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(() => {
                const main = document.querySelector('main');
                if (main) {
                    main.style.opacity = '1';
                    main.style.visibility = 'visible';
                }
            }, 0);
        });
    </script>
    
</body>
</html>
