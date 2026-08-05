@extends('layouts.app')

@section('title', 'Tambah Produk - SecondThrift')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">

<div class="container py-4" style="max-width: 1200px;">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold text-white mb-1">Tambah Produk</h3>
            <p class="text-secondary small mb-0">Isi data produk baru yang akan ditambahkan ke katalog sistem.</p>
        </div>
        <a href="{{ route('produk.index') }}" class="btn btn-secondary bg-secondary bg-opacity-25 border-secondary border-opacity-50 text-white px-3 py-2 fw-semibold rounded-2 shadow-sm">
            Kembali
        </a>
    </div>

    <div class="card bg-dark border-secondary border-opacity-25 shadow-sm overflow-hidden rounded-3">
        <div class="card-body p-4 p-md-5">

            <form action="{{ route('produk.store') }}"
                  method="POST"
                  enctype="multipart/form-data">

                @csrf

                @include('Produk._form')

            </form>

        </div>
    </div>

</div>

<style>
    /* Latar Belakang Utama Aplikasi (Samakan dengan Log Penjualan) */
    body {
        background-color: #0b0f19 !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    /* Card Form */
    .card {
        background-color: #121824 !important;
    }

    /* Label Input */
    .form-label, label {
        color: #94a3b8 !important;
        font-weight: 500;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }

    /* Input Fields & Dropdown */
    .form-control, .form-select {
        background-color: #0b0f19 !important;
        border: 1px solid #212d3d !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 0.6rem 0.85rem;
        font-size: 0.9rem;
    }

    /* Placeholder Text */
    .form-control::placeholder {
        color: #64748b !important;
    }

    /* Focus State pada Input */
    .form-control:focus, .form-select:focus {
        border-color: #38bdf8 !important;
        box-shadow: 0 0 0 0.25rem rgba(56, 189, 248, 0.15) !important;
        color: #ffffff !important;
    }

    /* Input File Upload (Khusus Foto) */
    input[type="file"]::file-selector-button {
        background-color: #1e2638 !important;
        color: #38bdf8 !important;
        border: 1px solid #212d3d !important;
        border-radius: 6px;
        padding: 0.35rem 0.75rem;
        margin-right: 0.75rem;
    }

    /* Tombol Utama (Simpan) - Warna Biru */
    .btn-primary {
        background-color: #0d6efd !important;
        border-color: #0d6efd !important;
        color: #ffffff !important;
        font-weight: 600;
        border-radius: 8px !important;
        padding: 0.6rem 1.25rem;
    }

    .btn-primary:hover {
        background-color: #0b5ed7 !important;
        border-color: #0a58ca !important;
    }

    /* Tombol Sekunder / Kembali */
    .btn-secondary {
        border-radius: 8px !important;
    }
</style>
@endsection