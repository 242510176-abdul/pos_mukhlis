@extends('layouts.app')

@section('title', 'Manajemen Pengguna')

@section('content')

@include('layouts.navbar')

<!-- Font & Icon -->
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<div class="user-men-wrapper py-5">
    <div class="container">

        <!-- Header Banner Maskulin -->
        <div class="men-header mb-4 p-4 p-md-5 rounded-4 shadow-lg position-relative overflow-hidden">
            <div class="row align-items-center position-relative z-1">
                <div class="col-lg-8 mb-3 mb-lg-0">
                    <span class="badge bg-amber text-dark fw-bold text-uppercase px-3 py-2 mb-2 tracking-wider">
                        <i class="fa-solid fa-user-shield me-1"></i> Access Control
                    </span>
                    <h1 class="display-6 fw-extrabold text-white mb-1 brand-font">
                        MANAGEMENT <span class="text-amber">STAF & USER</span>
                    </h1>
                    <p class="text-slate-300 mb-0 fs-6">
                        Kelola tim, hak akses pengguna, dan kredensial sistem toko SPTYSTORE.
                    </p>
                </div>
                <div class="col-lg-4 text-lg-end">
                    <a href="{{ route('admin.users.create') }}" class="btn btn-add-user px-4 py-3 fw-bold rounded-3">
                        <i class="fa-solid fa-user-plus me-2"></i> Tambah User Baru
                    </a>
                </div>
            </div>
        </div>

        <!-- Search Bar & Filter -->
        <div class="search-box-men mb-4 p-2 rounded-3 bg-dark-slate border border-slate-700 shadow-sm">
            <form action="{{ route('admin.users') }}" method="GET">
                <div class="row g-2">
                    <div class="col-md-10">
                        <div class="input-group">
                            <span class="input-group-text bg-transparent border-0 text-slate-400 ps-3">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </span>
                           <input 
    type="text" 
    name="search" 
    value="{{ request('search') }}" 
    class="form-control bg-transparent border-0 shadow-none py-2 input-search-white" 
    placeholder="Cari berdasarkan nama atau alamat email staf..."
>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-amber w-100 py-2 fw-bold text-dark text-uppercase" type="submit">
                            Cari User
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Tabel Data User Modern Dark -->
        <div class="card bg-dark-slate border-slate-800 rounded-4 overflow-hidden shadow-lg">
            <div class="table-responsive">
                <table class="table table-dark table-hover mb-0 align-middle custom-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;" class="text-center text-slate-400">#</th>
                            <th class="text-slate-400 text-uppercase tracking-wider">Pengguna</th>
                            <th class="text-slate-400 text-uppercase tracking-wider">Email</th>
                            <th class="text-slate-400 text-uppercase tracking-wider">Role / Hak Akses</th>
                            <th style="width: 140px;" class="text-center text-slate-400 text-uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr>
                            <td class="text-center fw-bold text-slate-400">
                                {{ $loop->iteration }}
                            </td>
                            <td>
                                <div class="d-flex align-items-center gap-3">
                                    <div class="user-avatar text-uppercase fw-extrabold text-amber bg-dark-translucent border border-slate-700 rounded-circle d-flex align-items-center justify-content-center">
                                        {{ substr($user->name, 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="fw-bold text-white fs-6 mb-0">{{ $user->name }}</div>
                                        <small class="text-slate-400 extra-small">ID: #USR-00{{ $user->id }}</small>
                                    </div>
                                </div>
                            </td>
                            <td class="text-slate-300 font-monospace">
                                <i class="fa-regular fa-envelope me-2 text-slate-400"></i>{{ $user->email }}
                            </td>
                            <td>
                                @php
                                    $roleName = strtolower($user->role->name ?? '');
                                    $badgeClass = match($roleName) {
                                        'admin', 'superadmin' => 'badge-role-admin',
                                        'kasir', 'cashier' => 'badge-role-kasir',
                                        default => 'badge-role-default'
                                    };
                                @endphp
                                <span class="badge {{ $badgeClass }} px-3 py-2 text-uppercase font-monospace">
                                    <i class="fa-solid fa-shield-halved me-1"></i> {{ $user->role->name ?? 'No Role' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-action-edit" title="Edit Access">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>

                                    <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-action-delete" onclick="return confirm('Apakah Anda yakin ingin menghapus akun pengguna ini?')" title="Hapus User">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <div class="text-slate-400">
                                    <i class="fa-solid fa-user-slash fa-3x mb-3 text-slate-600"></i>
                                    <h5 class="text-white fw-bold mb-1">Data Pengguna Tidak Ditemukan</h5>
                                    <p class="mb-0 small">Coba ubah kata kunci pencarian atau tambah staf baru.</p>
                                </div>
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

    /* Style khusus untuk membuat placeholder berwarna putih terang */
.input-search-white::placeholder {
    color: rgba(255, 255, 255, 0.7) !important; /* Putih terang dengan sedikit efek soft */
    opacity: 1; /* Diperlukan untuk browser Firefox */
}

/* Warna saat difokuskan / diketik */
.input-search-white {
    color: #ffffff !important;
}
    /* ===== THEME: MASCULINE DARK STREETWEAR ===== */
    :root {
        --bg-main: #0b0f17;
        --bg-card: #151c28;
        --border-color: #242f42;
        --amber-accent: #f59e0b;
        --amber-hover: #d97706;
    }

    body {
        background-color: var(--bg-main) !important;
        color: #f8fafc;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .brand-font {
        font-family: 'Space Grotesk', sans-serif;
    }

    .text-amber {
        color: var(--amber-accent) !important;
    }

    .bg-amber {
        background-color: var(--amber-accent) !important;
    }

    .btn-amber {
        background-color: var(--amber-accent);
        color: #000;
        border: none;
        transition: all 0.3s ease;
    }

    .btn-amber:hover {
        background-color: var(--amber-hover);
        color: #000;
        transform: translateY(-2px);
    }

    .bg-dark-slate {
        background-color: var(--bg-card);
    }

    .border-slate-800 {
        border-color: var(--border-color) !important;
    }

    .border-slate-700 {
        border-color: #334155 !important;
    }

    .text-slate-300 { color: #cbd5e1; }
    .text-slate-400 { color: #94a3b8; }
    .text-slate-600 { color: #475569; }
    .extra-small { font-size: 0.75rem; }

    /* HEADER BANNER */
    .men-header {
        background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
        border: 1px solid var(--border-color);
    }

    .men-header::after {
        content: "";
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(245, 158, 11, 0.12) 0%, rgba(0,0,0,0) 70%);
        pointer-events: none;
    }

    .btn-add-user {
        background: #ffffff;
        color: #0f172a;
        border: none;
        transition: 0.3s;
    }

    .btn-add-user:hover {
        background: var(--amber-accent);
        color: #0f172a;
        transform: translateY(-2px);
    }

    /* TABLE STYLING */
    .custom-table {
        background-color: var(--bg-card) !important;
        border-color: var(--border-color);
    }

    .custom-table thead th {
        background-color: #0f172a !important;
        border-bottom: 2px solid var(--border-color);
        padding: 16px 20px;
        font-size: 0.8rem;
    }

    .custom-table tbody tr {
        border-bottom: 1px solid var(--border-color);
        transition: background-color 0.2s ease;
    }

    .custom-table tbody tr:hover {
        background-color: #1a2332 !important;
    }

    .custom-table td {
        padding: 16px 20px;
    }

    /* USER AVATAR BADGE */
    .user-avatar {
        width: 42px;
        height: 42px;
        font-size: 0.9rem;
        letter-spacing: 1px;
    }

    .bg-dark-translucent {
        background: rgba(15, 23, 42, 0.85);
    }

    /* ROLE BADGES */
    .badge-role-admin {
        background-color: rgba(245, 158, 11, 0.15);
        color: #f59e0b;
        border: 1px solid rgba(245, 158, 11, 0.3);
        border-radius: 6px;
    }

    .badge-role-kasir {
        background-color: rgba(56, 189, 248, 0.15);
        color: #38bdf8;
        border: 1px solid rgba(56, 189, 248, 0.3);
        border-radius: 6px;
    }

    .badge-role-default {
        background-color: rgba(148, 163, 184, 0.15);
        color: #94a3b8;
        border: 1px solid rgba(148, 163, 184, 0.3);
        border-radius: 6px;
    }

    /* ACTION BUTTONS */
    .btn-action-edit {
        background: #334155;
        color: #f59e0b;
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
        text-decoration: none;
    }

    .btn-action-edit:hover {
        background: #f59e0b;
        color: #000;
    }

    .btn-action-delete {
        background: rgba(239, 68, 68, 0.15);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.3);
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: 0.2s;
    }

    .btn-action-delete:hover {
        background: #ef4444;
        color: #fff;
    }
</style>

@endsection