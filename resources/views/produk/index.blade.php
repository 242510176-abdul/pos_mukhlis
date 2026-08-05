@extends('layouts.app')

@section('title', 'Produk - Sneaker Vault')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="vault-wrapper py-4 py-md-5">
    <div class="container vault-container">

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show vault-alert-danger mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-triangle-exclamation fa-lg me-3 text-danger"></i>
                    <div>
                        <strong>Gagal!</strong> {{ session('error') }}
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show vault-alert-success mb-4" role="alert">
                <div class="d-flex align-items-center">
                    <i class="fa-solid fa-circle-check fa-lg me-3 text-success"></i>
                    <div>
                        <strong>Berhasil!</strong> {{ session('success') }}
                    </div>
                </div>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="vault-header mb-5">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-4">
                <div>
                    <h1 class="vault-title mb-1">
                        Katalog Produk <span class="text-glow">Second Thrift</span>
                    </h1>
                    <p class="mb-0 text-muted-vault">
                        Daftar keseluruhan produk-produk yang ada dalam SecondThrift
                    </p>
                </div>

                @can('create', App\Models\Produk::class)
                <div>
                    <a href="{{ route('produk.create') }}" class="btn-vault-add">
                        <i class="fa-solid fa-plus me-2"></i> Tambah Koleksi
                    </a>
                </div>
                @endcan
            </div>
        </div>

        <div class="vault-search-card mb-5">
            <form action="{{ route('produk.index') }}" method="GET">
                <div class="row g-2 align-items-center">
                    <div class="col-lg-10">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 ps-3 text-muted">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                            <input 
                                type="text"
                                name="search"
                                class="form-control border-0 bg-transparent py-3 ps-2 vault-input"
                                placeholder="Cari brand, model sneaker, atau seri..."
                                value="{{ request('search') }}"
                            >
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn-vault-search w-100 py-3">
                            <i class="fa-solid fa-magnifying-glass me-1"></i> Cari
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <div class="row g-4">

            @forelse($products as $product)
            <div class="col-xl-3 col-lg-4 col-md-6">
                <div class="vault-card h-100 d-flex flex-column">

                    <div class="vault-image-container">
                        <div class="vault-badge-stock">
                            <i class="fa-solid fa-box me-1"></i> Stok: {{ $product->stok }}
                        </div>
                        <img src="{{ asset('storage/'.$product->foto) }}" alt="{{ $product->nama }}">
                    </div>

                    <div class="vault-body d-flex flex-column flex-grow-1">
                        <div class="vault-brand">
                            Second Thrift Official
                        </div>

                        <div class="vault-product-name mt-1">
                            {{ $product->nama }}
                        </div>

                        <div class="vault-pricing-box mt-3">
                            <div class="vault-price">
                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                            </div>
                            <div class="vault-modal">
                                Modal: Rp {{ number_format($product->harga_beli, 0, ',', '.') }}
                            </div>
                        </div>

                        <div class="vault-action-group mt-auto pt-3">
                            <a href="{{ route('produk.show', $product) }}" class="btn-vault-action btn-vault-detail" title="Detail">
                                <i class="fa-solid fa-eye"></i>
                            </a>

                            @can('update', $product)
                            <a href="{{ route('produk.edit', $product) }}" class="btn-vault-action btn-vault-edit" title="Edit">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            @endcan

                            @can('delete', $product)
                            <form action="{{ route('produk.destroy', $product) }}" method="POST" class="d-inline flex-grow-1 m-0">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-vault-action btn-vault-delete w-100" onclick="return confirm('Hapus produk ini dari vault?')">
                                    <i class="fa-solid fa-trash me-1"></i> Hapus
                                </button>
                            </form>
                            @endcan
                        </div>
                    </div>

                </div>
            </div>
            @empty
            
            <div class="col-12 text-center py-5">
                <div class="vault-empty-state p-5">
                    <i class="fa-solid fa-box-open fa-3x text-muted mb-3"></i>
                    <h3 class="text-white fw-bold mb-1">Belum Ada Item di Vault</h3>
                    <p class="text-muted mb-0">Coba gunakan kata kunci pencarian lain atau tambahkan produk baru.</p>
                </div>
            </div>

            @endforelse

        </div>

        <div class="d-flex justify-content-center mt-5">
            {{ $products->links() }}
        </div>

    </div>
</div>

<style>
    /* ===== INDUSTRIAL DARK MASCULINE & STREETWEAR THEME ===== */
    :root {
        --vault-bg: #090b10;
        --vault-surface: #121620;
        --vault-surface-card: #181d2b;
        --vault-border: #252e42;
        --vault-accent: #38bdf8;
        --vault-accent-glow: rgba(56, 189, 248, 0.2);
        --vault-text: #f1f5f9;
        --vault-muted: #94a3b8;
    }

    body {
        background-color: var(--vault-bg);
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--vault-text);
        min-height: 100vh;
    }

    /* Ambient Industrial Lighting */
    body::before {
        content: "";
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-image: 
            radial-gradient(circle at 15% 20%, rgba(56, 189, 248, 0.08) 0%, transparent 40%),
            radial-gradient(circle at 85% 80%, rgba(37, 99, 235, 0.06) 0%, transparent 40%);
        pointer-events: none;
        z-index: -1;
    }

    .vault-container {
        max-width: 1300px;
    }

    /* CUSTOM ALERTS */
    .vault-alert-danger {
        background-color: rgba(239, 68, 68, 0.1);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #f87171;
        border-radius: 12px;
    }

    .vault-alert-success {
        background-color: rgba(34, 197, 94, 0.1);
        border: 1px solid rgba(34, 197, 94, 0.3);
        color: #4ade80;
        border-radius: 12px;
    }

    /* HEADER BANNER */
    .vault-header {
        background: linear-gradient(135deg, #121620 0%, #1a233a 100%);
        border: 1px solid var(--vault-border);
        border-radius: 20px;
        padding: 40px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .vault-header::after {
        content: "";
        position: absolute;
        top: -50px;
        right: -50px;
        width: 200px;
        height: 200px;
        background: var(--vault-accent);
        filter: blur(80px);
        opacity: 0.15;
    }

    .vault-tag {
        display: inline-block;
        background: rgba(56, 189, 248, 0.1);
        color: var(--vault-accent);
        border: 1px solid rgba(56, 189, 248, 0.25);
        padding: 6px 14px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .vault-title {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 2.2rem;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .text-glow {
        color: var(--vault-accent);
        text-shadow: 0 0 20px rgba(56, 189, 248, 0.4);
    }

    .text-muted-vault {
        color: var(--vault-muted);
        font-size: 1rem;
    }

    /* BUTTON TAMBAH */
    .btn-vault-add {
        background: #ffffff;
        color: #090b10;
        border: none;
        padding: 14px 26px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.25s ease;
        box-shadow: 0 10px 25px rgba(255, 255, 255, 0.1);
    }

    .btn-vault-add:hover {
        background: var(--vault-accent);
        color: #090b10;
        transform: translateY(-2px);
        box-shadow: 0 15px 30px rgba(56, 189, 248, 0.3);
    }

    /* SEARCH CARD */
    .vault-search-card {
        background: var(--vault-surface);
        border: 1px solid var(--vault-border);
        border-radius: 16px;
        padding: 10px 16px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
    }

    .vault-input {
        color: #ffffff !important;
        font-size: 0.95rem;
    }

    .vault-input::placeholder {
        color: var(--vault-muted);
    }

    .vault-input:focus {
        box-shadow: none;
        background: transparent !important;
    }

    .btn-vault-search {
        background: #252e42;
        color: #ffffff;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        transition: all 0.2s ease;
    }

    .btn-vault-search:hover {
        background: var(--vault-accent);
        color: #090b10;
    }

    /* PRODUCT CARD */
    .vault-card {
        background: var(--vault-surface-card);
        border: 1px solid var(--vault-border);
        border-radius: 16px;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        position: relative;
    }

    .vault-card:hover {
        transform: translateY(-6px);
        border-color: var(--vault-accent);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.5), 0 0 15px var(--vault-accent-glow);
    }

    /* IMAGE CONTAINER */
    .vault-image-container {
        height: 220px;
        background: #12151d;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 20px;
        border-bottom: 1px solid var(--vault-border);
    }

    .vault-image-container img {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: transform 0.4s ease;
    }

    .vault-card:hover .vault-image-container img {
        transform: scale(1.08) rotate(-2deg);
    }

    .vault-badge-stock {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(18, 22, 32, 0.85);
        backdrop-filter: blur(4px);
        color: var(--vault-accent);
        border: 1px solid var(--vault-border);
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 700;
    }

    /* CARD BODY */
    .vault-body {
        padding: 20px;
    }

    .vault-brand {
        font-size: 0.7rem;
        color: var(--vault-accent);
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .vault-product-name {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #ffffff;
        line-height: 1.4;
    }

    .vault-pricing-box {
        background: rgba(9, 11, 16, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.04);
        padding: 12px;
        border-radius: 10px;
    }

    .vault-price {
        font-family: 'Syne', sans-serif;
        color: #ffffff;
        font-size: 1.25rem;
        font-weight: 800;
    }

    .vault-modal {
        color: var(--vault-muted);
        font-size: 0.75rem;
        font-family: monospace;
        margin-top: 2px;
    }

    /* ACTION BUTTONS */
    .vault-action-group {
        display: flex;
        gap: 6px;
    }

    .btn-vault-action {
        border-radius: 10px;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 8px 12px;
        border: 1px solid var(--vault-border);
        transition: all 0.2s ease;
        text-align: center;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }

    .btn-vault-detail {
        background: #1e2638;
        color: #cbd5e1;
    }
    .btn-vault-detail:hover {
        background: #2b3752;
        color: #ffffff;
        border-color: #3b82f6;
    }

    .btn-vault-edit {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border-color: rgba(245, 158, 11, 0.3);
    }
    .btn-vault-edit:hover {
        background: #f59e0b;
        color: #000000;
    }

    .btn-vault-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
        border-color: rgba(239, 68, 68, 0.3);
    }
    .btn-vault-delete:hover {
        background: #ef4444;
        color: #ffffff;
    }

    /* EMPTY STATE */
    .vault-empty-state {
        background: var(--vault-surface);
        border: 2px dashed var(--vault-border);
        border-radius: 20px;
    }

    /* PAGINATION */
    .pagination {
        gap: 6px;
    }

    .page-link {
        background: var(--vault-surface) !important;
        border: 1px solid var(--vault-border) !important;
        color: var(--vault-muted) !important;
        border-radius: 10px !important;
        padding: 10px 16px;
        font-weight: 700;
    }

    .page-item.active .page-link {
        background: var(--vault-accent) !important;
        color: #090b10 !important;
        border-color: var(--vault-accent) !important;
        box-shadow: 0 0 15px var(--vault-accent-glow);
    }
</style>
@endsection