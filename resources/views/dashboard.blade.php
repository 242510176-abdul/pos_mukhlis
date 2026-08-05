@extends('layouts.app')

@section('title', 'Dashboard - SecondThrif')

@section('content')

@include('layouts.navbar')

<!-- Google Fonts & FontAwesome -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="dashboard-wrapper py-4 py-md-5">
    <div class="container dashboard-container">

        <!-- HEADER BANNER -->
        <div class="dashboard-header mb-4">
            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                <div>
                    <span class="badge badge-accent mb-2">
                        <i class="fa-solid fa-bolt me-1"></i> Command Center
                    </span>
                    <h1 class="store-title mb-1 text-white">
                        <i class="fa-solid fa-vest me-2 text-accent"></i> SecondThrif Dashboard
                    </h1>
                    <p class="mb-0 text-gray-light">
                        Monitor performa penjualan, arus kas, dan kontrol inventaris store secara real-time.
                    </p>
                </div>

                <div class="date-badge">
                    <i class="fa-regular fa-calendar-days me-2 text-accent"></i>
                    <span>{{ $tanggalHariIni->translatedFormat('l, d F Y') }}</span>
                </div>
            </div>
        </div>

        @can('viewAny', App\Models\User::class)
        <!-- SECTION: RINGKASAN PENJUALAN -->
        <div class="section-title mb-3">
            <h5><i class="fa-solid fa-chart-pie me-2 text-accent"></i> Ringkasan Penjualan Hari Ini</h5>
        </div>

        <div class="row g-3 mb-4">
            <div class="col-md-4">
                <div class="stat-card primary-card">
                    <div class="stat-icon">
                        <i class="fa-solid fa-wallet"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Penjualan</span>
                        <h3 class="stat-value">Rp {{ number_format($ringkasan['total_penjualan'], 0, ',', '.') }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-amber">
                        <i class="fa-solid fa-receipt"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Transaksi</span>
                        <h3 class="stat-value">{{ number_format($ringkasan['total_transaksi']) }} <small class="unit">Order</small></h3>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="stat-card">
                    <div class="stat-icon icon-steel">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <div class="stat-info">
                        <span class="stat-label">Total Qty Terjual</span>
                        <h3 class="stat-value">{{ number_format($ringkasan['total_qty_terjual'] ?? 0) }} <small class="unit">Pcs</small></h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- SECTION: TIPE PEMBAYARAN -->
        <div class="row g-3 mb-4">
            <div class="col-md-6">
                <div class="payment-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="payment-icon cash">
                            <i class="fa-solid fa-money-bill-wave"></i>
                        </div>
                        <div>
                            <span class="stat-label">Kas Tunai (Cash)</span>
                            <h4 class="payment-value">Rp {{ number_format($ringkasan['total_cash'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="payment-card">
                    <div class="d-flex align-items-center gap-3">
                        <div class="payment-icon cashless">
                            <i class="fa-solid fa-qrcode"></i>
                        </div>
                        <div>
                            <span class="stat-label">Non-Tunai / QRIS</span>
                            <h4 class="payment-value">Rp {{ number_format($ringkasan['total_non_tunai'], 0, ',', '.') }}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endcan

        <!-- SECTION: STATUS INVENTARIS STOK -->
        <div class="section-title mb-3">
            <h5><i class="fa-solid fa-boxes-stacked me-2 text-accent"></i> Status Stok Produk</h5>
        </div>

        <div class="row g-3 mb-4">
            <!-- STOK MENIPIS -->
            <div class="col-md-6">
                <div class="table-card h-100">
                    <div class="table-card-header warning-header">
                        <i class="fa-solid fa-triangle-exclamation me-2"></i> Stok Menipis
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="25%" class="text-end">Sisa Stok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokRendah as $index => $produk)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $produkStokRendah->firstItem() + $index }}</td>
                                    <td class="fw-semibold text-white">{{ $produk->nama }}</td>
                                    <td class="text-end">
                                        <span class="stock-badge warning">
                                            {{ $produk->stok }} Pcs
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fa-solid fa-circle-check text-success me-1"></i> Semua stok produk dalam batas aman.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($produkStokRendah->hasPages())
                    <div class="p-3 border-top border-dark d-flex justify-content-center">
                        {{ $produkStokRendah->links() }}
                    </div>
                    @endif
                </div>
            </div>

            <!-- STOK HABIS -->
            <div class="col-md-6">
                <div class="table-card h-100">
                    <div class="table-card-header danger-header">
                        <i class="fa-solid fa-circle-xmark me-2"></i> Stok Habis
                    </div>
                    <div class="table-responsive">
                        <table class="table table-custom mb-0">
                            <thead>
                                <tr>
                                    <th width="10%">#</th>
                                    <th>Nama Produk</th>
                                    <th width="25%" class="text-end">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($produkStokHabis as $index => $produk)
                                <tr>
                                    <td class="fw-bold text-muted">{{ $produkStokHabis->firstItem() + $index }}</td>
                                    <td class="fw-semibold text-white">{{ $produk->nama }}</td>
                                    <td class="text-end">
                                        <span class="stock-badge danger">
                                            Habis
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        <i class="fa-solid fa-circle-check text-success me-1"></i> Tidak ada produk yang kehabisan stok.
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    @if($produkStokHabis->hasPages())
                    <div class="p-3 border-top border-dark d-flex justify-content-center">
                        {{ $produkStokHabis->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- SECTION: PRODUK TERLARIS -->
        <div class="section-title mb-3">
            <h5><i class="fa-solid fa-fire me-2 text-accent"></i> Produk Terlaris (Top Items)</h5>
        </div>

        <div class="table-card mb-4">
            <div class="table-responsive">
                <table class="table table-custom table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nama Produk</th>
                            <th>Status Stok Saat Ini</th>
                            <th class="text-end">Total Terjual</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($produkTerlaris as $produk)
                        <tr>
                            <td class="fw-bold text-white">
                                <i class="fa-solid fa-tag me-2 text-accent"></i>{{ $produk->nama }}
                            </td>
                            <td>
                                @if($produk->stok > 5)
                                    <span class="stock-badge success">{{ $produk->stok }} Pcs</span>
                                @elseif($produk->stok > 0)
                                    <span class="stock-badge warning">{{ $produk->stok }} Pcs</span>
                                @else
                                    <span class="stock-badge danger">Habis</span>
                                @endif
                            </td>
                            <td class="text-end fw-bold text-accent fs-6">
                                {{ number_format($produk->total_terjual) }} <small class="text-muted fw-normal">Pcs</small>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="text-center text-muted py-4">Belum ada data produk terjual.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<style>
    /* ===== MASCULINE DARK INDUSTRIAL THEME ===== */
    :root {
        --bg-main: #0b0f19;          /* Obsidian Dark */
        --card-bg: #131b2e;          /* Dark Steel Card */
        --card-border: #1e293b;      /* Muted Border */
        --accent-gold: #f59e0b;      /* Cyber Amber / Gold */
        --text-main: #f8fafc;
        --text-muted: #94a3b8;
    }

    body {
        background-color: var(--bg-main) !important;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: var(--text-main);
    }

    .dashboard-container {
        max-width: 1280px;
    }

    /* HEADER BANNER */
    .dashboard-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e1b4b 50%, #090d16 100%);
        color: white;
        border-radius: 16px;
        padding: 28px 32px;
        border: 1px solid #1e293b;
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.5);
        position: relative;
        overflow: hidden;
    }

    .dashboard-header::after {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.15) 0%, rgba(0,0,0,0) 70%);
        border-radius: 50%;
        pointer-events: none;
    }

    .store-title {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.8rem;
        letter-spacing: -0.5px;
    }

    .badge-accent {
        background: rgba(245, 158, 11, 0.15);
        color: var(--accent-gold);
        border: 1px solid rgba(245, 158, 11, 0.3);
        padding: 6px 12px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
    }

    .text-accent {
        color: var(--accent-gold) !important;
    }

    .text-gray-light {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .date-badge {
        background: rgba(15, 23, 42, 0.6);
        backdrop-filter: blur(8px);
        padding: 10px 18px;
        border-radius: 10px;
        border: 1px solid var(--card-border);
        color: white;
        font-weight: 600;
        font-size: 0.9rem;
    }

    /* SECTION TITLE */
    .section-title h5 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.1rem;
        color: var(--text-main);
        margin-bottom: 0;
        letter-spacing: 0.5px;
    }

    /* STAT CARDS */
    .stat-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 20px 24px;
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        display: flex;
        align-items: center;
        gap: 16px;
        transition: all 0.25s ease;
    }

    .stat-card:hover {
        transform: translateY(-3px);
        border-color: rgba(245, 158, 11, 0.4);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.4);
    }

    .stat-card.primary-card {
        background: linear-gradient(135deg, #1e1b4b, #312e81);
        border: 1px solid #4338ca;
    }

    .stat-card.primary-card .stat-label {
        color: #c7d2fe;
    }

    .stat-card.primary-card .stat-value {
        color: white;
    }

    .stat-card.primary-card .stat-icon {
        background: rgba(255, 255, 255, 0.1);
        color: var(--accent-gold);
    }

    .stat-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .icon-amber {
        background: rgba(245, 158, 11, 0.1);
        color: #f59e0b;
    }

    .icon-steel {
        background: rgba(56, 189, 248, 0.1);
        color: #38bdf8;
    }

    .stat-label {
        font-size: 0.8rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        display: block;
        margin-bottom: 2px;
    }

    .stat-value {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.4rem;
        color: var(--text-main);
        margin-bottom: 0;
    }

    .stat-value .unit {
        font-size: 0.85rem;
        font-weight: 500;
        color: var(--text-muted);
    }

    /* PAYMENT CARDS */
    .payment-card {
        background: var(--card-bg);
        border-radius: 14px;
        padding: 18px 24px;
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    }

    .payment-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
    }

    .payment-icon.cash {
        background: rgba(22, 163, 74, 0.15);
        color: #4ade80;
    }

    .payment-icon.cashless {
        background: rgba(2, 132, 199, 0.15);
        color: #38bdf8;
    }

    .payment-value {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
        font-size: 1.25rem;
        color: var(--text-main);
        margin-bottom: 0;
    }

    /* TABLE CARDS */
    .table-card {
        background: var(--card-bg);
        border-radius: 14px;
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        overflow: hidden;
    }

    .table-card-header {
        padding: 14px 20px;
        font-weight: 700;
        font-size: 0.9rem;
        border-bottom: 1px solid var(--card-border);
    }

    .table-card-header.warning-header {
        background: rgba(180, 83, 9, 0.15);
        color: #fbbf24;
    }

    .table-card-header.danger-header {
        background: rgba(185, 28, 28, 0.15);
        color: #f87171;
    }

    .table-custom {
        margin-bottom: 0;
        color: var(--text-main);
    }

    .table-custom thead th {
        background: #0f172a;
        color: var(--text-muted);
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        border-bottom: 1px solid var(--card-border);
        padding: 12px 20px;
        letter-spacing: 0.5px;
    }

    .table-custom tbody td {
        padding: 12px 20px;
        border-bottom: 1px solid var(--card-border);
        font-size: 0.9rem;
        background: transparent;
    }

    .table-custom tbody tr:hover td {
        background: rgba(255, 255, 255, 0.02);
    }

    .table-custom tbody tr:last-child td {
        border-bottom: none;
    }

    /* STOCK BADGES */
    .stock-badge {
        padding: 4px 10px;
        border-radius: 6px;
        font-size: 0.75rem;
        font-weight: 700;
        display: inline-block;
    }

    .stock-badge.warning {
        background: rgba(245, 158, 11, 0.15);
        color: #fbbf24;
    }

    .stock-badge.danger {
        background: rgba(239, 68, 68, 0.15);
        color: #f87171;
    }

    .stock-badge.success {
        background: rgba(34, 197, 94, 0.15);
        color: #4ade80;
    }

    /* PAGINATION OVERRIDE */
    .pagination {
        margin-bottom: 0;
        gap: 4px;
    }

    .page-link {
        background: var(--card-bg) !important;
        border: 1px solid var(--card-border) !important;
        border-radius: 8px !important;
        color: var(--text-muted) !important;
        font-weight: 600;
        padding: 6px 12px;
        font-size: 0.85rem;
    }

    .page-item.active .page-link {
        background: var(--accent-gold) !important;
        border-color: var(--accent-gold) !important;
        color: #0b0f19 !important;
    }
</style>
@endsection