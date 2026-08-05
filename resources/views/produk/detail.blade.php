@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<!-- Tambahkan CDN Google Fonts & FontAwesome untuk nuansa feminim dan elegan -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body {
    background: linear-gradient(135deg, #fdf6f9, #f4e8ee);
    font-family: 'Plus Jakarta Sans', sans-serif;
    color: #4a3540;
}

/* Dekorasi background mewah yang lembut */
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

/* CONTAINER & CARD STYLING */
.detail-product-container {
    max-width: 650px;
    margin: 40px auto;
}

.detail-aesthetic-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    border-radius: 30px;
    border: 1px solid rgba(254, 205, 211, 0.4);
    box-shadow: 0 15px 35px rgba(225, 29, 72, 0.08);
    overflow: hidden;
    width: 100% !important; /* Mengubah ukuran card bawaan agar lebih proporsional & mewah */
}

.detail-header-title {
    font-family: 'Playfair Display', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: #4a3540;
}

.detail-img-wrapper {
    background: #fff5f7;
    padding: 30px;
    display: flex;
    justify-content: center;
    align-items: center;
    border-bottom: 1px solid #fff1f2;
}

.detail-img-wrapper img {
    max-height: 280px;
    object-fit: contain;
    border-radius: 20px;
    transition: transform 0.4s ease;
}

.detail-img-wrapper img:hover {
    transform: scale(1.05);
}

.detail-card-body {
    padding: 35px;
}

.detail-title-nama {
    font-family: 'Playfair Display', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: #4a3540;
    margin-bottom: 20px;
}

.detail-info-row {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px 0;
    border-bottom: 1px dashed #fbe8ee;
    font-size: 0.95rem;
}

.detail-info-label {
    color: #885d6e;
    font-weight: 600;
}

.detail-info-value {
    color: #4a3540;
    font-weight: 700;
}

.detail-price-highlight {
    color: #be123c !important;
    font-size: 1.1rem;
}

/* TOMBOL KEMBALI */
.btn-back-aesthetic {
    background: #f43f5e;
    color: white;
    border: none;
    border-radius: 14px;
    padding: 12px;
    font-weight: 700;
    transition: 0.3s;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    box-shadow: 0 4px 15px rgba(225, 29, 72, 0.2);
}

.btn-back-aesthetic:hover {
    background: #e11d48;
    color: white;
    transform: translateY(-2px);
}
</style>

<div class="container detail-product-container">

    <div class="text-center mb-4">
        <h1 class="detail-header-title">
            <i class="fa-solid fa-gem me-2" style="color: #be123c;"></i> Halaman Detail Produk
        </h1>
        <p style="color: #885d6e;">Informasi lengkap koleksi sepatu SPTYSTORE</p>
    </div>

    <!-- Mempertahankan struktur class="card" tapi dipercantik dengan class tambahan detail-aesthetic-card -->
    <div class="card detail-aesthetic-card mx-auto">
        
        <div class="detail-img-wrapper">
            <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top" alt="{{ $produk->nama }}">
        </div>

        <div class="card-body detail-card-body">
            
            <h5 class="card-title detail-title-nama">
                {{ $produk->nama }}
            </h5>

            <div class="mb-4">
                <div class="detail-info-row">
                    <span class="detail-info-label"><i class="fa-solid fa-tag me-2 text-pink"></i> Harga Dasar</span>
                    <span class="detail-info-value">Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}</span>
                </div>

                <div class="detail-info-row">
                    <span class="detail-info-label"><i class="fa-solid fa-tags me-2" style="color: #be123c;"></i> Harga Jual</span>
                    <span class="detail-info-value detail-price-highlight">Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}</span>
                </div>

                <div class="detail-info-row">
                    <span class="detail-info-label"><i class="fa-solid fa-boxes-stacked me-2 text-pink"></i> Stok</span>
                    <span class="detail-info-value">
                        <span class="badge rounded-pill px-3 py-2" style="background: #ffe4e6; color: #9f1239;">
                            {{ $produk->stok }} Psg
                        </span>
                    </span>
                </div>

                <div class="detail-info-row border-0">
                    <span class="detail-info-label"><i class="fa-solid fa-user-pen me-2 text-pink"></i> Penginput</span>
                    <span class="detail-info-value" style="color: #885d6e;">{{ $produk->user->name }}</span>
                </div>
            </div>

            <a href="{{ route('produk.index') }}" class="btn btn-primary btn-back-aesthetic w-100">
                <i class="fa-solid fa-arrow-left"></i> Kembali ke Katalog
            </a>

        </div>
    </div>

</div>

@endsection