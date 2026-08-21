@extends('layouts.app')

@section('title', 'Penjualan - Sneaker Vault')

@section('content')

@include('layouts.navbar')

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="container py-4" style="max-width: 1200px;">

    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <div>
            <h3 class="fw-bold text-white mb-1">Log Penjualan</h3>
            <p class="text-secondary small mb-0">Kelola dan pantau seluruh riwayat transaksi kasir secara real-time.</p>
        </div>
        <a href="{{ route('penjualan.create') }}" class="btn btn-primary px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm rounded-3">
            Tambah Transaksi
        </a>
    </div>

    @if(session('errors'))
    <div class="alert alert-warning border-0 bg-warning bg-opacity-10 text-warning d-flex align-items-center gap-2 mb-3 py-2 px-3 small rounded-3">
        <div>{{ session('errors') }}</div>
    </div>
    @endif

    @if(session('success'))
    <div class="alert alert-success border-0 bg-success bg-opacity-10 text-success d-flex align-items-center gap-2 mb-3 py-2 px-3 small rounded-3">
        <div>{{ session('success') }}</div>
    </div>
    @endif

    <div class="card bg-dark border-secondary border-opacity-25 mb-4 shadow-sm rounded-3">
        <div class="card-body p-2">
            <form action="{{ route('penjualan.index') }}" method="GET">
                <div class="input-group">
                    <input 
    type="text"
    name="search"
    value="{{ request()->search }}"
    class="form-control border-0 bg-transparent text-white shadow-none ps-3 input-search-white"
    placeholder="Cari berdasarkan nama kasir atau metode pembayaran..."
>
                    <button type="submit" class="btn btn-secondary bg-secondary bg-opacity-25 border-0 text-white px-4 fw-semibold rounded-2">
                        Cari
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="card bg-dark border-secondary border-opacity-25 shadow-sm overflow-hidden mb-4 rounded-3">
        <div class="table-responsive">
            <table class="table table-dark table-hover align-middle mb-0 small">
                <thead>
                    <tr class="text-secondary border-secondary border-opacity-25">
                        <th class="ps-3 py-3 fw-semibold">No. Order</th>
                        <th class="py-3 fw-semibold">Waktu & Tanggal</th>
                        <th class="py-3 fw-semibold">Admin/Kasir</th>
                        <th class="py-3 fw-semibold">Pembayaran</th>
                        <th class="py-3 fw-semibold">Total</th>
                        <th class="py-3 fw-semibold">Status</th>
                        <th class="text-end pe-3 py-3 fw-semibold">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                    <tr class="border-secondary border-opacity-25">
                        <td class="ps-3 fw-bold text-white">
                            #{{ $sale->id }}
                        </td>

                        <td>
                            <div class="text-white fw-medium">
                                {{ $sale->created_at->timezone('Asia/Jakarta')->format('d/m/Y') }}
                            </div>
                            <div class="text-secondary opacity-75" style="font-size: 0.75rem;">
                                {{ $sale->created_at->timezone('Asia/Jakarta')->format('H:i') }} WIB
                            </div>
                        </td>

                        <td>
                            <span class="fw-semibold text-white">{{ $sale->user->name ?? 'Kasir Vault' }}</span>
                        </td>

                        <td>
                            <span class="badge bg-secondary bg-opacity-25 text-light border border-secondary border-opacity-50 fw-normal px-2 py-1 rounded-2">
                                {{ $sale->metode_pembayaran }}
                            </span>
                        </td>

                        <td>
                            <span class="fw-bold text-info">
                                Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}
                            </span>
                        </td>

                        <td>
                            @php 
                                $status = strtoupper($sale->status ?? ''); 
                            @endphp

                            @if($status === 'COMPLETED')
                                <span class="badge bg-success bg-opacity-25 text-success border border-success border-opacity-25 px-3 py-2 rounded-2 fw-bold text-uppercase fs-7">
                                    Completed
                                </span>
                            @elseif($status === 'OPEN')
                                <span class="badge bg-warning bg-opacity-25 text-warning border border-warning border-opacity-25 px-3 py-2 rounded-2 fw-bold text-uppercase fs-7">
                                    Open
                                </span>
                            @else
                                <span class="badge bg-danger bg-opacity-25 text-danger border border-danger border-opacity-25 px-3 py-2 rounded-2 fw-bold text-uppercase fs-7">
                                    Batal
                                </span>
                            @endif
                        </td>

                        <td class="text-end pe-3">
                            <div class="d-flex justify-content-end gap-1">
                                <a href="{{ route('penjualan.show', $sale) }}" class="btn btn-sm btn-dark border border-secondary text-light px-2 py-1 rounded-2" title="Detail Transaksi">
                                    Detail
                                </a>

                                @if($sale->status === 'OPEN')
                                    <a href="{{ route('penjualan.edit', $sale) }}" class="btn btn-sm btn-warning px-2 py-1 fw-medium rounded-2" title="Lanjut Transaksi">
                                        Edit
                                    </a>

                                    <form action="{{ route('penjualan.destroy', $sale) }}" method="POST" class="d-inline m-0">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger px-2 py-1 rounded-2" title="Hapus Transaksi" onclick="return confirm('Yakin ingin menghapus transaksi #{{ $sale->id }} ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-5">
                            <div class="text-secondary py-3">
                                <h6 class="text-white fw-bold mb-1">Belum Ada Catatan Transaksi</h6>
                                <p class="small mb-0">Belum ada aktivitas penjualan yang terekam di sistem saat ini.</p>
                            </div>
                        </td>
                    </tr>
                    @endempty
                </tbody>
            </table>
        </div>
    </div>

    <div class="d-flex justify-content-center">
        {{ $sales->links() }}
    </div>

</div>

<style>
    /* Mengubah warna teks placeholder menjadi putih */
.input-search-white::placeholder {
    color: rgba(255, 255, 255, 0.7) !important; /* Warna putih soft */
    opacity: 1; /* Diperlukan agar warna solid di browser Firefox */
}

/* Memastikan teks yang diketik tetap putih */
.input-search-white {
    color: #ffffff !important;
}
    body {
        background-color: #0b0f19;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    
    .table-dark {
        --bs-table-bg: transparent;
        --bs-table-hover-bg: rgba(255, 255, 255, 0.03);
    }

    .fs-7 {
        font-size: 0.825rem !important;
        letter-spacing: 0.5px;
    }

    .pagination {
        --bs-pagination-bg: #121824;
        --bs-pagination-border-color: #212d3d;
        --bs-pagination-color: #94a3b8;
        --bs-pagination-hover-bg: #1e2638;
        --bs-pagination-hover-color: #ffffff;
        --bs-pagination-hover-border-color: #212d3d;
        --bs-pagination-active-bg: #38bdf8;
        --bs-pagination-active-border-color: #38bdf8;
        --bs-pagination-active-color: #0b0f19;
        gap: 4px;
    }

    .page-link {
        border-radius: 6px !important;
        font-size: 0.85rem;
        font-weight: 600;
        padding: 6px 12px;
    }
</style>
@endsection