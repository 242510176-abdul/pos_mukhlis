@extends('layouts.app')

@section('title', 'Detail Transaksi #' . $penjualan->id)

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="vault-wrapper py-4 py-md-5">
    <div class="container vault-container" style="max-width: 950px;">

        <div class="vault-header mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <span class="vault-tag mb-2">Transaction Detail</span>
                    <h1 class="vault-title mb-1">
                        Struk Transaksi <span class="text-glow">#{{ $penjualan->id }}</span>
                    </h1>
                    <p class="mb-0 text-muted-vault">
                        Rincian item dan status pembayaran untuk transaksi ini.
                    </p>
                </div>
                <div>
                    <a href="{{ route('penjualan.index') }}" class="btn-vault-back">
                        <i class="fa-solid fa-arrow-left me-2"></i> Kembali
                    </a>
                </div>
            </div>
        </div>

        <div class="vault-card mb-4 p-4">
            <div class="row g-4">
                <div class="col-md-3 col-6">
                    <p class="vault-info-label mb-1"><i class="fa-solid fa-user-gear me-1"></i> Kasir</p>
                    <h6 class="vault-info-value">{{ $penjualan->user->name ?? '-' }}</h6>
                </div>
                <div class="col-md-3 col-6">
                    <p class="vault-info-label mb-1"><i class="fa-regular fa-calendar-days me-1"></i> Tanggal Transaksi</p>
                    <h6 class="vault-info-value">{{ $penjualan->created_at ? $penjualan->created_at->format('d/m/Y H:i') : '-' }}</h6>
                </div>
                <div class="col-md-3 col-6">
                    <p class="vault-info-label mb-1"><i class="fa-solid fa-wallet me-1"></i> Pembayaran</p>
                    <div>
                        <span class="badge vault-badge-payment">
                            {{ $penjualan->metode_pembayaran }}
                        </span>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <p class="vault-info-label mb-1"><i class="fa-solid fa-circle-info me-1"></i> Status</p>
                    <div>
                        <span class="badge {{ $penjualan->status === 'COMPLETED' ? 'vault-badge-success' : 'vault-badge-warning' }}">
                            {{ $penjualan->status }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="vault-card p-4">
            <h5 class="vault-card-title mb-4">
                <i class="fa-solid fa-boxes-packing me-2 text-glow"></i> Daftar Produk
            </h5>

            <div class="table-responsive">
                <table class="table vault-table align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Produk</th>
                            <th class="text-center">Harga Satuan</th>
                            <th class="text-center">Qty</th>
                            <th class="text-end">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penjualan->itemPenjualan as $item)
                            <tr>
                                <td>
                                    <div class="fw-bold vault-product-title">
                                        {{ $item->produk->nama ?? $item->produk_name ?? 'Produk Dihapus' }}
                                    </div>
                                </td>
                                <td class="text-center vault-td-muted">
                                    Rp {{ number_format($item->harga ?? $item->harga_satuan ?? ($item->produk->harga_jual ?? 0), 0, ',', '.') }}
                                </td>
                                <td class="text-center">
                                    <span class="vault-qty-badge">{{ $item->kuantitas }}</span>
                                </td>
                                <td class="text-end fw-bold vault-td-subtotal">
                                    Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-bold vault-total-label">Total Pembayaran:</td>
                            <td class="text-end fw-bold vault-total-amount">
                                Rp {{ number_format($penjualan->total_pembayaran, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </div>
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

    /* HEADER BANNER */
    .vault-header {
        background: linear-gradient(135deg, #121620 0%, #1a233a 100%);
        border: 1px solid var(--vault-border);
        border-radius: 20px;
        padding: 30px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    .vault-tag {
        display: inline-block;
        background: rgba(56, 189, 248, 0.1);
        color: var(--vault-accent);
        border: 1px solid rgba(56, 189, 248, 0.25);
        padding: 4px 12px;
        border-radius: 30px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .vault-title {
        font-family: 'Syne', sans-serif;
        font-weight: 800;
        font-size: 1.8rem;
        color: #ffffff;
    }

    .text-glow {
        color: var(--vault-accent);
        text-shadow: 0 0 15px rgba(56, 189, 248, 0.4);
    }

    .text-muted-vault {
        color: var(--vault-muted);
    }

    /* BUTTON BACK */
    .btn-vault-back {
        background: #1e2638;
        color: #cbd5e1;
        border: 1px solid var(--vault-border);
        padding: 10px 20px;
        border-radius: 12px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        transition: all 0.25s ease;
    }

    .btn-vault-back:hover {
        background: #2b3752;
        color: #ffffff;
        border-color: var(--vault-accent);
    }

    /* CARDS */
    .vault-card {
        background: var(--vault-surface-card);
        border: 1px solid var(--vault-border);
        border-radius: 16px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
    }

    .vault-card-title {
        font-family: 'Syne', sans-serif;
        font-weight: 700;
        color: #ffffff;
    }

    .vault-info-label {
        font-size: 0.75rem;
        color: var(--vault-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .vault-info-value {
        color: #ffffff;
        font-weight: 700;
        font-size: 0.95rem;
        margin: 0;
    }

    /* BADGES */
    .vault-badge-payment {
        background: rgba(56, 189, 248, 0.15);
        color: var(--vault-accent);
        border: 1px solid rgba(56, 189, 248, 0.3);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
    }

    .vault-badge-success {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
    }

    .vault-badge-warning {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
        border: 1px solid rgba(245, 158, 11, 0.3);
        padding: 6px 12px;
        border-radius: 8px;
        font-weight: 700;
    }

    .vault-qty-badge {
        background: #121620;
        border: 1px solid var(--vault-border);
        color: var(--vault-accent);
        padding: 4px 10px;
        border-radius: 6px;
        font-weight: 700;
        font-size: 0.85rem;
    }

    /* OVERRIDE BOOTSTRAP TABLE STYLES */
    .vault-table {
        --bs-table-bg: transparent !important;
        --bs-table-accent-bg: transparent !important;
        --bs-table-striped-bg: transparent !important;
        --bs-table-hover-bg: transparent !important;
        color: var(--vault-text) !important;
    }

    .vault-table thead th {
        background: #121620 !important;
        color: var(--vault-muted) !important;
        border-bottom: 1px solid var(--vault-border) !important;
        text-transform: uppercase;
        font-size: 0.75rem;
        letter-spacing: 1px;
        padding: 14px;
    }

    .vault-table tbody td {
        padding: 16px 14px;
        border-bottom: 1px solid rgba(37, 46, 66, 0.5) !important;
        background: transparent !important;
    }

    .vault-product-title {
        color: #ffffff !important;
        font-size: 0.95rem;
    }

    .vault-td-muted {
        color: var(--vault-muted) !important;
    }

    .vault-td-subtotal {
        color: #ffffff !important;
    }

    .vault-table tfoot td {
        padding-top: 20px;
        border-top: 2px solid var(--vault-border) !important;
        background: transparent !important;
    }

    .vault-total-label {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem;
        color: var(--vault-muted) !important;
    }

    .vault-total-amount {
        font-family: 'Syne', sans-serif;
        font-size: 1.4rem;
        color: var(--vault-accent) !important;
        text-shadow: 0 0 10px rgba(56, 189, 248, 0.3);
    }
</style>
@endsection