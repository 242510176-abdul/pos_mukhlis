@extends('layouts.app')

@section('title', 'POS Kasir')

@section('content')

@include('layouts.navbar')

<!-- CDN Google Fonts & FontAwesome -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body{
    background:#f4f6f9;
    font-family:'Poppins',sans-serif;
    color:#333;
}

.pos-container{
    max-width:1300px;
    margin:30px auto;
}

.pos-title{
    font-size:28px;
    font-weight:600;
    color:#2c3e50;
}

.pos-card{
    background:#fff;
    border-radius:10px;
    box-shadow:0 2px 10px rgba(0,0,0,.08);
    border:none;
}

.pos-card .card-body,
.pos-card .card-footer{
    padding:20px;
}

.pos-card .card-footer{
    border-top:1px solid #e9ecef;
    background:#fff;
}

.pos-search-input{
    border:1px solid #ced4da;
    border-radius:8px;
}

.pos-search-input:focus{
    border-color:#0d6efd;
    box-shadow:none;
}

.product-item-btn{
    width:100%;
    background:#fff;
    border:1px solid #dee2e6;
    border-radius:8px;
    padding:10px;
    text-align:left;
    transition:.2s;
}

.product-item-btn:hover{
    background:#f8f9fa;
}

.pos-qty-input{
    text-align:center;
    border-radius:6px;
}

.btn-plus{
    background:#0d6efd;
    color:#fff;
    border:none;
}

.btn-plus:hover{
    background:#0b5ed7;
    color:#fff;
}

.pos-table th{
    background:#f8f9fa;
    font-weight:600;
}

.pos-table td{
    vertical-align:middle;
}

.total-price-text{
    font-size:22px;
    font-weight:700;
    color:#0d6efd;
}

.btn-checkout{
    background:#198754;
    color:#fff;
    border:none;
}

.btn-checkout:hover{
    background:#157347;
    color:#fff;
}

.btn-cancel-trans{
    background:#363333;
    color:#fff;
    border:none;
}

.btn-cancel-trans:hover{
    background:#323030;
    color:#fff;
}
</style>

<div class="container pos-container">

    @if(session('errors'))
        <div class="alert alert-danger border-0 shadow-sm rounded-4 mb-4" style="background: #ffe4e6; color: #9f1239;">
            <i class="fa-solid fa-triangle-exclamation me-2"></i> {{ session('errors') }}
        </div>
    @endif

    <div class="d-flex align-items-center justify-content-between mb-4">
        <h4 class="pos-title mb-0">
            <i class="fa-solid fa-cash-register me-2" style="color: #1d1b1b;"></i> Kasir 
        </h4>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary px-3 py-2 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="fa-solid fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-4">

        {{-- ===== DAFTAR PRODUK (KIRI) ===== --}}
        <div class="col-lg-6">
            <div class="pos-card h-100">
                <div class="card-body" style="max-height: 72vh; overflow-y: auto;">

                    <div class="mb-4">
                        <form method="GET" action="{{ route('penjualan.create') }}">
                            <input
                                type="text"
                                name="search"
                                value="{{ request('search') }}"
                                class="form-control pos-search-input"
                                placeholder="Cari koleksi produk..."
                                onkeyup="this.form.submit()">
                        </form>
                    </div>

                    @foreach ($products as $product)
                        <form method="POST"
                            action="{{ route('itempenjualan.store') }}"
                            class="row g-2 mb-3 align-items-center">
                            @csrf

                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            <div class="col-7">
                                <button
                                    type="submit"
                                    class="product-item-btn {{ $sale->status === 'COMPLETED' ? 'disabled opacity-50' : '' }}"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="{{ asset('storage/'.$product->foto) }}"
                                             alt="Gambar"
                                             class="rounded-circle shadow-sm"
                                             style="width: 48px; height: 48px; object-fit: cover; border: 2px solid #fecdd3;">

                                        <div>
                                            <div class="fw-bold" style="color: #4a3540; font-size: 0.95rem;">{{ $product->nama }}</div>
                                            <small style="color: #2306f8; font-weight: 700;">
                                                Rp {{ number_format($product->harga_jual, 0, ',', '.') }}
                                            </small>
                                        </div>
                                    </div>
                                </button>
                            </div>

                            <div class="col-3">
                                <input type="number"
                                       name="quantity"
                                       value="1"
                                       min="1"
                                       class="form-control pos-qty-input py-2"
                                       {{ $sale->status === 'COMPLETED' ? 'readonly' : '' }}>
                            </div>

                            <div class="col-2">
                                <button
                                    type="submit"
                                    class="btn btn-plus w-100 py-2 {{ $sale->status === 'COMPLETED' ? 'disabled opacity-50' : '' }}"
                                    {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                                    <i class="fa-solid fa-plus"></i>
                                </button>
                            </div>
                        </form>
                    @endforeach

                </div>
            </div>
        </div>

        {{-- ===== KERANJANG BELANJA & PEMBAYARAN (KANAN) ===== --}}
        <div class="col-lg-6">
            <div class="pos-card h-100 d-flex flex-column justify-content-between">
                
                <div class="table-responsive" style="max-height: 42vh; overflow-y: auto;">
                    <table class="table pos-table mb-0">
                        <thead>
                            <tr>
                                <th>Produk</th>
                                <th>Harga</th>
                                <th style="width: 90px;">Qty</th>
                                <th>Subtotal</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($sale->itempenjualan as $item)
                                <tr>
                                    <td>
                                        <div class="fw-bold" style="font-size: 0.9rem;">{{ $item->produk->nama }}</div>
                                    </td>
                                    <td class="small">Rp {{ number_format($item->produk->harga_jual, 0, ',', '.') }}</td>
                                    <td>
                                        <form method="POST" action="{{ route('itempenjualan.update', $item->id) }}">
                                            @csrf @method('PUT')
                                            <input type="number"
                                                   name="quantity"
                                                   value="{{ $item->kuantitas }}"
                                                   class="form-control form-control-sm pos-qty-input"
                                                   onchange="this.form.submit()">
                                        </form>
                                    </td>
                                    <td class="fw-bold" style="color: #0927e4;">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                                    <td class="text-center">
                                        @can('delete', $item)
                                        <form method="POST" action="{{ route('itempenjualan.destroy', $item->id) }}">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-sm text-danger border-0 bg-transparent" title="Hapus Item">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="fa-solid fa-bag-shopping fa-2x mb-2 text-pink opacity-50" style="color: #f43f5e;"></i>
                                        <p class="mb-0 small">Keranjang belanja masih kosong</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted fw-semibold">Total Pembayaran:</span>
                        <span class="total-price-text fw-bold">Rp {{ number_format($sale->total_pembayaran, 0, ',', '.') }}</span>
                    </div>

                    <form method="POST" 
                          action="{{ route('penjualan.update', $sale->id) }}"
                          onsubmit="return confirm('Yakin ingin checkout transaksi ini?')" class="mb-2">
                        @csrf
                        @method('PUT')
                        
                        <input type="hidden" name="status" value="COMPLETED">

                        <select name="payment_method" class="form-select mb-3" required>
                            <option value="">✨ Pilih Metode Pembayaran</option>
                            <option value="CASH">CASH (Tunai)</option>
                            <option value="QRIS">QRIS (Digital)</option>
                        </select>

                        <button class="btn btn-checkout w-100 py-3" {{ $sale->status === 'COMPLETED' ? 'disabled' : '' }}>
                            <i class="fa-solid fa-circle-check me-2"></i> Checkout Transaksi
                        </button>
                    </form>

                    @can('delete', $sale)
                    <form action="{{ route('penjualan.destroy', $sale->id) }}"
                          method="POST" 
                          onsubmit="return confirm('Yakin ingin membatalkan transaksi?')">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-cancel-trans w-100">
                            <i class="fa-solid fa-ban me-2"></i> Batal Transaksi
                        </button>
                    </form>
                    @endcan
                </div>

            </div>
        </div>

    </div>

</div>

@endsection