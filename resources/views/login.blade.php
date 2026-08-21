@extends('layouts.app')

@section('title', 'Login - Second Thrift')

@section('content')

<style>
    /* 1. Paksa Body Mengikuti Tema Dark & Reset Flex */
    html, body {
        background-color: #0b0f19 !important;
        margin: 0 !important;
        padding: 0 !important;
        overflow-x: hidden;
        height: 100%;
    }

    /* 2. Layer Background Bergerak Penuh Layar */
    .bg-animated-layer {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 0;
        background: linear-gradient(-45deg, #0b0f19, #1e1b4b, #0284c7, #0f172a, #06b6d4);
        background-size: 300% 300%;
        animation: moveGradient 7s ease infinite;
    }

    @keyframes moveGradient {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* 3. Pembungkus Sentralisasi (Pasti di Tengah Layar) */
    .login-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 2;
        padding: 15px;
    }

    /* 4. Kartu Transparan (Glassmorphism Effect) */
    .glass-card {
        background: rgba(15, 23, 42, 0.8) !important;
        backdrop-filter: blur(16px);
        -webkit-backdrop-filter: blur(16px);
        border: 1px solid rgba(56, 189, 248, 0.25) !important;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.7) !important;
    }

    /* 5. Form Input & Icon Custom */
    .custom-input-group .input-group-text {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-right: none !important;
        color: #38bdf8 !important;
    }

    .custom-input-group .form-control {
        background-color: rgba(255, 255, 255, 0.08) !important;
        border: 1px solid rgba(255, 255, 255, 0.15) !important;
        border-left: none !important;
        color: #ffffff !important;
    }

    .custom-input-group .form-control::placeholder {
        color: #94a3b8 !important;
    }

    .custom-input-group .form-control:focus {
        background-color: rgba(255, 255, 255, 0.15) !important;
        color: #ffffff !important;
        border-color: #38bdf8 !important;
        box-shadow: none !important;
    }

    /* 6. Tombol Glow Cyan */
    .btn-glow {
        background: linear-gradient(90deg, #0284c7, #06b6d4) !important;
        border: none !important;
        color: #ffffff !important;
        transition: all 0.3s ease;
    }

    .btn-glow:hover {
        background: linear-gradient(90deg, #0369a1, #0891b2) !important;
        box-shadow: 0 0 20px rgba(6, 182, 212, 0.5) !important;
    }
</style>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

<div class="bg-animated-layer"></div>

<div class="login-wrapper">
    <div class="card border-0 shadow-lg w-100 glass-card" style="max-width: 400px; border-radius: 16px;">
        
        <div class="card-header text-center bg-transparent border-0 pt-4 pb-2">
            <h4 class="mb-1 fw-bold tracking-wider text-uppercase text-white" style="letter-spacing: 1.5px; font-weight: 800;">
                SECOND<span style="color: #38bdf8;">THRIFT</span>
            </h4>
            <p class="small mb-0" style="color: #94a3b8;"></p>
        </div>

        <div class="card-body px-4 pb-4 pt-2">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="email" class="form-label text-light small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Email</label>
                    <div class="input-group custom-input-group">
                        <span class="input-group-text">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" 
                               class="form-control @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com" value="{{ old('email') }}" required autofocus>
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block mt-1" style="color: #f87171;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label text-light small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Password</label>
                    <div class="input-group custom-input-group">
                        <span class="input-group-text">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" 
                               class="form-control @error('password') is-invalid @enderror" 
                               placeholder="••••••••" required>
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block mt-1" style="color: #f87171;">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <button type="submit" class="btn btn-glow fw-bold text-uppercase w-100 py-2.5 mt-2" style="letter-spacing: 1px; border-radius: 8px;">
                    Masuk
                </button>
            </form>
        </div>

        <div class="card-footer bg-transparent border-0 text-center pb-4 pt-0">
        </div>
    </div>
</div>

@endsection