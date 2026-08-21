<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">

    <!-- Isi title yang kita kirimkan dari views lain -->
    <title>@yield('title')</title>

    <!-- memanggil link bootstrap -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

<div class="container mt-3">

    @if(session('success'))
        <div id="success-alert" class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Isi konten yang kita kirimkan dari views lain -->
    @yield('content')

</div>

<!-- Script untuk menghilangkan alert otomatis setelah 5 detik -->
<script>
    setTimeout(function() {
        let alertElement = document.getElementById('success-alert');
        if (alertElement) {
            // Mengubah opacity perlahan atau langsung menghapusnya
            alertElement.style.transition = 'opacity 0.5s ease';
            alertElement.style.opacity = '0';
            
            // Hapus elemen dari DOM setelah animasi selesai
            setTimeout(function() {
                alertElement.remove();
            }, 500);
        }
    }, 5000); // 5000 milidetik = 5 detik
</script>

</body>
</html>