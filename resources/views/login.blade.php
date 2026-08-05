@extends('layouts.app')

@section('title', 'Login - Second Thrift')

@section('content')

<div class="container d-flex justify-content-center align-items-center" style="min-height: 85vh;">
    <div class="card border-0 shadow-lg w-100 text-dark" style="max-width: 400px; background-color: #E0F2FE; border-radius: 12px;">
        
        <!-- Header -->
        <div class="card-header text-center bg-transparent border-0 pt-4 pb-2">
            <h4 class="mb-1 fw-black tracking-wider text-uppercase" style="letter-spacing: 1.5px; font-weight: 800;">
                SECOND<span class="text-primary">THRIFT</span>
            </h4>
            <p class="text-muted small mb-0">Masuk untuk akses drop & koleksi eksklusif.</p>
        </div>

        <div class="card-body px-4 pb-4 pt-2">
            <form action="{{ route('auth') }}" method="POST">
                @csrf

                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label text-secondary small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Email</label>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-secondary-subtle text-secondary">
                            <i class="bi bi-envelope"></i>
                        </span>
                        <input type="email" id="email" name="email" 
                               class="form-control bg-white text-dark border-secondary-subtle @error('email') is-invalid @enderror" 
                               placeholder="nama@email.com" value="{{ old('email') }}" required autofocus
                               style="box-shadow: none;">
                    </div>
                    @error('email')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <label for="password" class="form-label text-secondary small fw-bold text-uppercase" style="letter-spacing: 0.5px;">Password</label>
                    </div>
                    <div class="input-group">
                        <span class="input-group-text bg-white border-secondary-subtle text-secondary">
                            <i class="bi bi-lock"></i>
                        </span>
                        <input type="password" id="password" name="password" 
                               class="form-control bg-white text-dark border-secondary-subtle @error('password') is-invalid @enderror" 
                               placeholder="••••••••" required
                               style="box-shadow: none;">
                    </div>
                    @error('password')
                        <div class="invalid-feedback d-block">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Submit Button -->
                <button type="submit" class="btn btn-dark w-100 py-2 fw-bold text-uppercase shadow-sm" style="letter-spacing: 1px; border-radius: 6px;">
                    Masuk Sekarang
                </button>
            </form>
        </div>

        <!-- Footer Card -->
        <div class="card-footer bg-transparent border-0 text-center pb-4 pt-0">
            
        </div>
    </div>
</div>

{{-- Tambahkan Bootstrap Icons jika belum ada di layouts.app --}}
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<style>
    /* Styling tambahan untuk input form focus agar elegan di background biru muda */
    .form-control:focus {
        background-color: #ffffff !important;
        color: #000 !important;
        border-color: #0d6efd !important; /* Warna aksen biru */
    }
    .input-group-text {
        border-right: none;
    }
    .form-control {
        border-left: none;
    }
    .form-control:focus + .input-group-text {
        border-color: #0d6efd !important;
    }
</style>
@endpush

@endsection