@extends('layouts.app')

@section('title', 'Profil - SMKN 4 BOGOR')

@section('content')
    <!-- Hero Section: Background Image -->
    <style>
        .hero-banner-profile {
            position: relative;
            height: 60vh;
            min-height: 400px;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #334155 100%), url('/images/dashboarad.JPG') center/cover no-repeat;
            background-blend-mode: overlay;
        }
        .hero-banner-profile .overlay {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.8) 0%, rgba(30, 41, 59, 0.6) 50%, rgba(51, 65, 85, 0.8) 100%);
            backdrop-filter: blur(1px);
        }
        .hero-banner-profile h1 {
            text-shadow: 2px 2px 4px rgba(0,0,0,0.7);
            font-weight: 800;
        }
        .hero-banner-profile p {
            text-shadow: 1px 1px 2px rgba(0,0,0,0.7);
        }
    </style>
    <section class="hero-banner-profile">
        <div class="overlay"></div>
        <div class="container h-100 position-relative" style="z-index:2;">
            <div class="row align-items-center h-100">
                <div class="col-lg-8 text-white">
                    <h1 class="display-4 fw-bold mb-3">Profil SMKN 4 BOGOR</h1>
                    <p class="lead mb-0 text-white-75">Mengenal lebih dekat dengan SMK Negeri 4 Kota Bogor</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Profile Content -->
    <section class="py-5 section-fade-in">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    @if($profile)
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4">
                                <h2 class="card-title text-primary mb-4">{{ $profile->judul }}</h2>
                                <div class="profile-content">
                                    {!! nl2br(e($profile->isi)) !!}
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-body p-4 text-center">
                                <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Profil Sekolah</h5>
                                <p class="text-muted">Informasi profil sekolah akan segera tersedia</p>
                            </div>
                        </div>
                    @endif

                    <!-- Vision & Mission -->
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4 text-center">
                                    <div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-eye fa-2x text-primary"></i>
                                    </div>
                                    <h5 class="card-title">Visi</h5>
                                    <p class="card-text text-muted">
                                        "Menjadi SMK Unggulan yang menghasilkan lulusan berkualitas, berkarakter, dan siap kerja sesuai standar industri nasional dan internasional."
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm h-100">
                                <div class="card-body p-4 text-center">
                                    <div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                                        <i class="fas fa-bullseye fa-2x text-success"></i>
                                    </div>
                                    <h5 class="card-title">Misi</h5>
                                    <p class="card-text text-muted">
                                        "Menyelenggarakan pendidikan kejuruan yang berkualitas, mengembangkan potensi siswa secara optimal, dan membangun kerjasama dengan dunia industri."
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4">
                    <!-- Quick Info -->
                    <div class="card border-0 shadow-sm mb-4">
                        <div class="card-header bg-primary text-white">
                            <h5 class="card-title mb-0">Informasi Sekolah</h5>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Alamat</h6>
                                    <p class="mb-0 small text-muted">Jl. Raya Tajur No. 33, Bogor</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-phone text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Telepon</h6>
                                    <p class="mb-0 small text-muted">(0251) 123456</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-envelope text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Email</h6>
                                    <p class="mb-0 small text-muted">info@smkn4bogor.sch.id</p>
                                </div>
                            </div>
                            
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-globe text-primary me-3"></i>
                                <div>
                                    <h6 class="mb-1">Website</h6>
                                    <p class="mb-0 small text-muted">www.smkn4bogor.sch.id</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Jurusan -->
                    <div class="card border-0 shadow-sm">
                        <div class="card-header bg-success text-white">
                            <h5 class="card-title mb-0">Program Keahlian</h5>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Teknik Komputer dan Jaringan
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Rekayasa Perangkat Lunak
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Teknik Pengelasan Fabrikasi Logam 
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    Teknik Otomotif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
