<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SecondThrift - Tentang Saya</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #0b0f19;
            color: #e2e8f0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .card-custom {
            background-color: #0f172a;
            border: 1px solid rgba(59, 130, 246, 0.2);
            border-radius: 12px;
        }
        .badge-system {
            background-color: rgba(245, 158, 11, 0.15);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }
        .navbar-dark .navbar-nav .nav-link:hover {
            color: #ffffff !important;
            background-color: rgba(59, 130, 246, 0.15);
        }

        /* --- STYLES ANIMASI 3D PROFILE --- */
        .profile-card-3d {
            background: linear-gradient(145deg, #1e293b, #0f172a);
            border: 1px solid rgba(59, 130, 246, 0.3);
            border-radius: 16px;
            transform-style: preserve-3d;
            perspective: 1000px;
            transition: box-shadow 0.3s ease;
        }
        .profile-card-3d:hover {
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.25);
        }
        .profile-img-container {
            position: relative;
            width: 140px;
            height: 140px;
            margin: 0 auto;
            transform: translateZ(30px); /* Efek pop-out 3D */
        }
        .profile-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #3b82f6;
            box-shadow: 0 0 20px rgba(59, 130, 246, 0.5);
        }
        .profile-content {
            transform: translateZ(20px); /* Melayang di atas card */
        }
    </style>
</head>
<body>

    <!-- Navbar Component -->
    <nav class="navbar navbar-expand-lg navbar-dark border-bottom border-primary border-opacity-25 py-2" style="background-color: #0f172a;">
        <div class="container" style="max-width: 1200px;">
            <a class="navbar-brand fw-bold text-white fs-4 d-flex align-items-center gap-2" href="#">
                SecondThrift
            </a>

            <button class="navbar-toggler border-0 shadow-none text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-lg-1">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('dashboard') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('dashboard') }}">
                            Dashboard
                        </a>
                    </li>  

                    @if(auth()->check() && strtolower(auth()->user()->role->name) === 'admin')
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('admin/users') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('admin.users') }}">
                            Users
                        </a>
                    </li>
                    @endif

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('produk*') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('produk.index') }}">
                            Produk
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('penjualan*') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('penjualan.index') }}">
                            Penjualan
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('tentang*') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('tentang.index') }}">
                            Tentang
                        </a>
                    </li>
                </ul>

                <div class="d-flex align-items-center mt-3 mt-lg-0">
                    <form action="{{ route('logout') }}" method="POST" class="m-0 w-100">
                        @csrf
                        <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2 fw-semibold rounded-2 w-100">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5" style="max-width: 1100px;">
        
        <!-- Header Section -->
        <div class="card card-custom p-4 mb-4 shadow-sm" style="background: linear-gradient(135deg, #1e1b4b 0%, #0f172a 100%);">
            <div class="d-flex align-items-center gap-2 mb-2">
                <span class="badge badge-system px-3 py-2 rounded-pill font-monospace fs-7">⚡ SYSTEM INFO</span>
            </div>
            <h2 class="fw-bold text-white mb-2">Tentang SecondThrift POS</h2>
            <p class="text-secondary mb-0" style="max-width: 750px;">
                Sistem Manajemen Kasir & Inventaris Produk Thrift yang dirancang untuk mempercepat transaksi, pencatatan arus kas, serta pemantauan ketersediaan stok barang secara real-time.
            </p>
        </div>

        <!-- SECTION PROFIL PRIBADI ANIMASI 3D -->
        <div class="card profile-card-3d p-4 mb-4 text-center" data-tilt data-tilt-max="12" data-tilt-speed="400" data-tilt-glare data-tilt-max-glare="0.2">
            <div class="profile-img-container mb-3">
                <!-- Ganti URL di bawah dengan lokasi foto kamu -->
                <img src="{{ asset('img/logo.jpg') }}" alt="Foto Profil" class="profile-img">
            </div>
            <div class="profile-content">
                <h4 class="fw-bold text-white mb-1">ABDUL MUKHLIS</h4>
                <h5 class="fw-bold text-white mb-1">Siswa SMK Negeri 4 Tasikmalaya</h5>
                <p class="text-primary fw-semibold mb-2">Lead Developer & Designer</p>
                <p class="text-secondary fs-7 mx-auto mb-3" style="max-width: 600px;">
                    "Pengembang aplikasi SecondThrift POS. Berfokus pada pembangunan sistem transaksi yang responsif, modern, dan mudah digunakan."
                </p>
                <div class="d-flex justify-content-center gap-2">
                    <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fs-7">Fullstack Dev</span>
                    <span class="badge bg-primary bg-opacity-25 text-primary border border-primary border-opacity-25 px-3 py-2 rounded-pill fs-7">UI/UX Designer</span>
                </div>
            </div>
        </div>

        <!-- Details Grid -->
        <div class="row g-4 mb-4">
            <!-- Card 1 -->
            <div class="col-md-4">
                <div class="card card-custom h-100 p-4 shadow-sm">
                    <div class="fs-2 mb-3">💻</div>
                    <h6 class="text-secondary text-uppercase fw-semibold tracking-wide fs-7 mb-1">Pengembang Sistem</h6>
                    <h5 class="fw-bold text-white mb-2">Tim Developer</h5>
                    <p class="text-secondary fs-7 mb-0">
                        Bertanggung jawab mengelola dan mengembangkan sistem POS agar transaksi penjualan produk berjalan efisien dan aman.
                    </p>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col-md-4">
                <div class="card card-custom h-100 p-4 shadow-sm">
                    <div class="fs-2 mb-3">🚀</div>
                    <h6 class="text-secondary text-uppercase fw-semibold tracking-wide fs-7 mb-1">Versi Aplikasi</h6>
                    <h5 class="fw-bold text-white mb-2">v2.4.0 (Stable)</h5>
                    <p class="text-secondary fs-7 mb-0">
                        Mendukung pengelolaan akun kasir/admin, inventaris stok otomatis, serta rekapitulasi data penjualan harian.
                    </p>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col-md-4">
                <div class="card card-custom h-100 p-4 shadow-sm">
                    <div class="fs-2 mb-3">🛠️</div>
                    <h6 class="text-secondary text-uppercase fw-semibold tracking-wide fs-7 mb-1">Dukungan Teknis</h6>
                    <h5 class="fw-bold text-white mb-2">support@secondthrift.id</h5>
                    <p class="text-secondary fs-7 mb-0">
                        Hubungi tim admin jika memerlukan bantuan teknis mengenai operasional akun atau sistem pembayaran.
                    </p>
                </div>
            </div>
        </div>

        <!-- Features List Section -->
        <div class="card card-custom p-4 shadow-sm">
            <h5 class="fw-bold text-white mb-3 d-flex align-items-center gap-2">
                <span class="text-warning">📌</span> Fitur Utama Aplikasi
            </h5>
            <div class="row g-3">
                <div class="col-md-3 col-6">
                    <div class="p-3 rounded-3 text-center border border-secondary border-opacity-25" style="background-color: #1e293b;">
                        <span class="fs-7 text-white">✓ Transaksi Kasir Cepat</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 rounded-3 text-center border border-secondary border-opacity-25" style="background-color: #1e293b;">
                        <span class="fs-7 text-white">✓ Monitor Stok Produk</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 rounded-3 text-center border border-secondary border-opacity-25" style="background-color: #1e293b;">
                        <span class="fs-7 text-white">✓ Rekap Laporan Penjualan</span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="p-3 rounded-3 text-center border border-secondary border-opacity-25" style="background-color: #1e293b;">
                        <span class="fs-7 text-white">✓ Manajemen Hak Akses</span>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Bootstrap 5 JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Vanilla Tilt JS untuk Animasi 3D Card -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vanilla-tilt/1.8.1/vanilla-tilt.min.js"></script>
</body>
</html>