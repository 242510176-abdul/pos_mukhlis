@extends('layouts.app')

@section('title', 'Detail Penjualan - SPTYSTORE')

@section('content')

@include('layouts.navbar')

<!-- Tambahkan CDN Google Fonts & FontAwesome -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-5">
    
    <!-- HEADER HALAMAN -->
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h2 class="sale-detail-title">
                <i class="fa-solid fa-receipt me-2 text-accent"></i> Detail Transaksi Penjualan
            </h2>
            <p class="text-muted small mb-0">Informasi lengkap rincian belanjaan dan kasir toko</p>
        </div>
        <div>
            <a href="javascript:history.back()" class="btn-back-aesthetic">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- KARTU INFORMASI TRANSAKSI -->
    <div class="row mb-5">
        <div class="col-md-6">
            <div class="card sale-info-card shadow-sm border-0 h-100">
                <div class="card-body p-4">
                    <div class="d-flex align-items-center mb-3">
                        <div class="icon-box me-3">
                            <i class="fa-solid fa-bag-shopping"></i>
                        </div>
                        <div>
                            <h5 class="card-title mb-1 fw-bold text-dark-rose">
                                Kasir : {{ $sale->user->name }}
                            </h5>
                            <h6 class="card-subtitle text-muted small">
                                <i class="fa-regular fa-calendar-days me-1"></i> Tanggal Transaksi : 
                                <span class="fw-semibold text-dark">{{ $sale->created_at->translatedFormat('d-m-Y H:i:s') }}</span>
                            </h6>
                        </div>
                    </div>
                    <hr class="text-muted opacity-25">
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <span class="text-muted fw-medium">Total Pembayaran :</span>
                        <h4 class="text-rose mb-0 fw-bold">Rp. {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL RINCIAN PRODUK -->
    <div class="card table-card shadow-sm border-0 p-3">
        <div class="card-body">
            <h4 class="h5 mb-4 fw-bold" style="font-family: 'Playfair Display', serif; color: #4a3540;">
                <i class="fa-solid fa-box-open me-2 text-rose"></i> Daftar Produk Dibeli
            </h4>

            <div class="table-responsive">
                <table class="table align-middle">
                    <thead>
                        <tr>
                            <th scope="col" style="width: 8%;">#</th>
                            <th scope="col" style="width: 15%;">Foto</th>
                            <th scope="col" style="width: 35%;">Nama Produk</th>
                            <th scope="col" style="width: 14%;">Harga Satuan</th>
                            <th scope="col" style="width: 13%;">Qty</th>
                            <th scope="col" style="width: 15%;">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp

                        @forelse($sale->itempenjualan as $item)
                        <tr>
                            <td class="fw-semibold">{{ $i++ }}</td>
                            <td>
                                <div class="product-img-wrapper">
                                    <img src="{{ asset('storage/' . $item->produk->foto) }}"
                                         alt="{{ $item->produk->nama }}">
                                </div>
                            </td>
                            <td>
                                <span class="fw-bold text-dark-rose">{{ $item->produk->nama }}</span>
                            </td>
                            <td>Rp. {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge qty-badge">
                                    {{ $item->jumlah ?? 1 }} pcs
                                </span>
                            </td>
                            <td>
                                <span class="fw-bold text-rose">
                                    Rp. {{ number_format(($item->produk->harga_jual * ($item->jumlah ?? 1)), 0, ',', '.') }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted text-center py-5">
                                <i class="fa-regular fa-face-sad-tear fa-2x mb-2 text-rose"></i><br>
                                Tidak ada data produk dalam transaksi ini.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<style>
    /* ===== TEMA BUTIK WANITA (ROSE GOLD, BLUSH PINK, CREAM) ===== */
    body {
        background: linear-gradient(135deg, #fdf6f9, #f4e8ee);
        font-family: 'Plus Jakarta Sans', sans-serif;
        min-height: 100vh;
        color: #4a3540;
    }

    body::before {
        content: "";
        position: fixed;
        width: 350px;
        height: 350px;
        background: #fbcfe8;
        border-radius: 50%;
        top: -100px;
        left: -100px;
        opacity: 0.3;
        filter: blur(70px);
        z-index: -1;
    }

    body::after {
        content: "";
        position: fixed;
        width: 400px;
        height: 400px;
        background: #fecdd3;
        border-radius: 50%;
        bottom: -150px;
        right: -150px;
        opacity: 0.3;
        filter: blur(80px);
        z-index: -1;
    }

    .container {
        max-width: 1200px;
    }

    /* Judul Halaman */
    .sale-detail-title {
        font-family: 'Playfair Display', serif;
        color: #881337;
        font-weight: 700;
        font-size: 2rem;
    }

    .text-accent {
        color: #201e1e !important;
    }

    .text-dark-rose {
        color: #881337 !important;
    }

    .text-rose {
        color: #1b191a !important;
    }

    /* Tombol Kembali Estetik */
    .btn-back-aesthetic {
        background: #ffffff;
        color: #090808;
        border: 1px solid #161616;
        padding: 10px 22px;
        border-radius: 20px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        box-shadow: 0 4px 15px rgba(225, 29, 72, 0.05);
        transition: 0.3s;
    }

    .btn-back-aesthetic:hover {
        background: #fff1f2;
        color: #9f1239;
        transform: translateY(-2px);
    }

    /* Kartu Informasi */
    .sale-info-card, .table-card {
        background: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(12px);
        border-radius: 24px;
        box-shadow: 0 12px 30px rgba(225, 29, 72, 0.06);
        border: 1px solid rgba(254, 205, 211, 0.5);
    }

    .icon-box {
        width: 50px;
        height: 50px;
        background: #fff1f2;
        color: #e11d48;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.25rem;
    }

    /* Tabel Estetik */
    .table {
        margin-bottom: 0;
    }

    .table thead th {
        background: #fff1f2;
        color: #881337;
        border: none;
        padding: 15px;
        font-size: 0.85rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table tbody td {
        padding: 15px;
        color: #4a3540;
        border-bottom: 1px solid #fce7f3;
        font-size: 0.95rem;
    }

    .table tbody tr:hover {
        background: #fff5f7;
    }

    /* Gambar Produk di Tabel */
    .product-img-wrapper {
        width: 65px;
        height: 65px;
        background: #fff5f7;
        border-radius: 12px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 1px solid #fecdd3;
    }

    .product-img-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    /* Badge Qty */
    .qty-badge {
        background: #ffe4e6;
        color: #9f1239;
        padding: 6px 14px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.85rem;
    }

    /* Animasi Masuk */
    .card {
        animation: muncul 0.5s ease;
    }

    @keyframes muncul {
        from {
            opacity: 0;
            transform: translateY(15px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

@endsection