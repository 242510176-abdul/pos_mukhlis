@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')

@include('layouts.navbar')

<style>
    .detail-page {
        padding: 40px 15px;
        background: #f4f8ff;
        min-height: 100vh;
    }

    .detail-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .detail-header h1 {
        color: #1e3a8a;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .detail-header p {
        color: #64748b;
        margin: 0;
    }

    .detail-card {
        max-width: 850px;
        margin: auto;
        background: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #dbeafe;
        box-shadow: 0 4px 15px rgba(30, 64, 175, 0.08);
    }

    .detail-image {
        background: #eff6ff;
        text-align: center;
        padding: 30px;
    }

    .detail-image img {
        width: 100%;
        max-width: 400px;
        height: 300px;
        object-fit: contain;
    }

    .detail-content {
        padding: 30px;
    }

    .detail-content h2 {
        color: #1e3a8a;
        font-size: 24px;
        font-weight: 700;
        margin-bottom: 25px;
    }

    .detail-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 0;
        border-bottom: 1px solid #e5e7eb;
    }

    .detail-row:last-child {
        border-bottom: none;
    }

    .detail-label {
        color: #64748b;
        font-size: 14px;
    }

    .detail-label i {
        color: #2563eb;
        width: 22px;
    }

    .detail-value {
        color: #1e293b;
        font-weight: 600;
        text-align: right;
    }

    .price {
        color: #2563eb;
        font-size: 19px;
    }

    .stock {
        background: #dbeafe;
        color: #1d4ed8;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 13px;
    }

    .btn-back {
        display: block;
        text-align: center;
        background: #2563eb;
        color: white;
        padding: 12px;
        border-radius: 8px;
        text-decoration: none;
        margin-top: 25px;
        font-weight: 600;
    }

    .btn-back:hover {
        background: #1d4ed8;
        color: white;
    }

    @media (min-width: 768px) {
        .detail-card {
            display: grid;
            grid-template-columns: 45% 55%;
        }

        .detail-image {
            display: flex;
            align-items: center;
            justify-content: center;
        }
    }

    @media (max-width: 767px) {
        .detail-content {
            padding: 20px;
        }

        .detail-row {
            gap: 15px;
        }
    }
</style>

<div class="detail-page">

    <div class="detail-header">
        <h1>
            <i class="fa-solid fa-shoe-prints"></i>
            Detail Produk
        </h1>
        <p>Informasi lengkap produk sepatu Second Thrift</p>
    </div>

    <div class="detail-card">

        {{-- Foto Produk --}}
        <div class="detail-image">
            <img
                src="{{ asset('storage/' . $produk->foto) }}"
                alt="{{ $produk->nama }}"
            >
        </div>

        {{-- Informasi Produk --}}
        <div class="detail-content">

            <h2>{{ $produk->nama }}</h2>

            <div class="detail-row">
                <span class="detail-label">
                    <i class="fa-solid fa-tag"></i>
                    Harga Dasar
                </span>

                <span class="detail-value">
                    Rp {{ number_format($produk->harga_beli, 0, ',', '.') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    <i class="fa-solid fa-tags"></i>
                    Harga Jual
                </span>

                <span class="detail-value price">
                    Rp {{ number_format($produk->harga_jual, 0, ',', '.') }}
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    <i class="fa-solid fa-box"></i>
                    Stok
                </span>

                <span class="detail-value">
                    <span class="stock">
                        {{ $produk->stok }} Pasang
                    </span>
                </span>
            </div>

            <div class="detail-row">
                <span class="detail-label">
                    <i class="fa-solid fa-user"></i>
                    Penginput
                </span>

                <span class="detail-value">
                    {{ $produk->user->name }}
                </span>
            </div>

            <a href="{{ route('produk.index') }}" class="btn-back">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Kembali ke Katalog
            </a>

        </div>

    </div>

</div>

@endsection