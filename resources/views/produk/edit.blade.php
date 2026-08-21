@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<style>
    .edit-page {
        min-height: 100vh;
        padding: 40px 15px;
        background: #f8fafc;
    }

    .edit-container {
        max-width: 750px;
        margin: auto;
    }

    .edit-header {
        margin-bottom: 25px;
    }

    .edit-header h1 {
        color: #1e3a8a;
        font-size: 28px;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .edit-header p {
        color: #64748b;
        margin: 0;
        font-size: 14px;
    }

    .edit-card {
        background: #ffffff;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        padding: 30px;
        box-shadow: 0 3px 12px rgba(15, 23, 42, 0.06);
    }

    .edit-card::before {
        content: "";
        display: block;
        height: 4px;
        background: #2563eb;
        border-radius: 10px 10px 0 0;
        margin: -30px -30px 25px;
    }

    .edit-title {
        display: flex;
        align-items: center;
        gap: 10px;
        color: #1e293b;
        font-size: 19px;
        font-weight: 600;
        margin-bottom: 25px;
    }

    .edit-title i {
        color: #2563eb;
    }

    .edit-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 25px;
        padding-top: 20px;
        border-top: 1px solid #e5e7eb;
        gap: 10px;
    }

    .btn-cancel {
        padding: 10px 18px;
        border-radius: 7px;
        border: 1px solid #cbd5e1;
        background: #ffffff;
        color: #475569;
        text-decoration: none;
        font-size: 14px;
        font-weight: 600;
    }

    .btn-cancel:hover {
        background: #f1f5f9;
        color: #334155;
    }

    .btn-update {
        padding: 10px 20px;
        border: none;
        border-radius: 7px;
        background: #2563eb;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
    }

    .btn-update:hover {
        background: #1d4ed8;
    }

    @media (max-width: 576px) {
        .edit-page {
            padding: 25px 12px;
        }

        .edit-card {
            padding: 20px;
        }

        .edit-card::before {
            margin: -20px -20px 20px;
        }

        .edit-header h1 {
            font-size: 24px;
        }

        .edit-footer {
            flex-direction: column-reverse;
        }

        .btn-cancel,
        .btn-update {
            width: 100%;
            text-align: center;
        }
    }
</style>

<div class="edit-page">

```
<div class="edit-container">

    <div class="edit-header">
        <h1>
            <i class="fa-solid fa-pen-to-square me-2"></i>
            Edit Produk
        </h1>
        <p>Perbarui informasi produk yang ingin diubah.</p>
    </div>

    <form action="{{ route('produk.update', $produk) }}"
          method="POST"
          enctype="multipart/form-data">

        @csrf
        @method('PUT')

        <div class="edit-card">

            <div class="edit-title">
                <i class="fa-solid fa-box"></i>
                Informasi Produk
            </div>

            @include('Produk._form')

            <div class="edit-footer">
                <a href="{{ route('produk.index') }}" class="btn-cancel">
                    <i class="fa-solid fa-arrow-left me-1"></i>
                    Batal
                </a>

                <button type="submit" class="btn-update">
                    <i class="fa-solid fa-save me-1"></i>
                    Simpan Perubahan
                </button>
            </div>

        </div>

    </form>

</div>
```

</div>

@endsection
