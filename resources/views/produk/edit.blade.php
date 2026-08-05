@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')

@include('layouts.navbar')

<!-- Tambahkan CDN Google Fonts & FontAwesome untuk nuansa feminim dan elegan -->
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

<style>
body{
    background: linear-gradient(135deg, #fdf6f9, #f4e8ee);
    font-family:'Plus Jakarta Sans', sans-serif;
    color: #4a3540;
}

/* Dekorasi background mewah yang lembut */
body::before {
    content: "";
    position: fixed;
    width: 350px;
    height: 350px;
    background: #fbcfe8;
    border-radius: 50%;
    top: -100px;
    left: -100px;
    opacity: 0.3;
    filter: blur(70px);
    z-index: -1;
}

body::after {
    content: "";
    position: fixed;
    width: 400px;
    height: 400px;
    background: #fecdd3;
    border-radius: 50%;
    bottom: -150px;
    right: -150px;
    opacity: 0.3;
    filter: blur(80px);
    z-index: -1;
}

/* CONTAINER & CARD WRAPPER */
.edit-product-container {
    max-width: 850px;
    margin: 40px auto;
}

.edit-product-card {
    background: rgba(255, 255, 255, 0.92);
    backdrop-filter: blur(12px);
    border-radius: 30px;
    padding: 40px;
    box-shadow: 0 15px 35px rgba(225, 29, 72, 0.08);
    border: 1px solid rgba(254, 205, 211, 0.4);
}

/* HEADER */
.edit-product-header {
    border-bottom: 2px solid #fff1f2;
    padding-bottom: 20px;
    margin-bottom: 30px;
}

.edit-product-header h4 {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 700;
    color: #4a3540;
    margin: 0;
}

.edit-product-header p {
    color: #885d6e;
    font-size: 0.95rem;
    margin-top: 5px;
    margin-bottom: 0;
}
</style>

<div class="container edit-product-container">
    <div class="edit-product-card">
        <div class="edit-product-header">
            <h4><i class="fa-solid fa-pen-to-square text-rose me-2" style="color: #be123c;"></i> Edit Produk</h4>
            <p>Perbarui informasi detail dan koleksi sepatu di sptystore</p>
        </div>

        <form action="{{ route('produk.update', $produk) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('Produk._form')
        </form>
    </div>
</div>

@endsection