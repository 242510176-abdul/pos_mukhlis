<nav class="navbar navbar-expand-lg navbar-dark border-bottom border-primary border-opacity-25 py-2" style="background-color: #0f172a;">
    <div class="container" style="max-width: 1200px;">
        <a class="navbar-brand fw-bold text-white fs-4 d-flex align-items-center gap-2" href="#">
            SecondThrift
        </a>

        <button class="navbar-toggler border-0 shadow-none text-white" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-lg-4 gap-lg-1">
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('dashboard') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('dashboard') }}">
                        Dashboard
                    </a>
                </li>  

                @if(auth()->check() && strtolower(auth()->user()->role->name) === 'admin')
                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('admin/users') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('admin.users') }}">
                        Users
                    </a>
                </li>
                @endif

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('produk*') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('produk.index') }}">
                        Produk
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link px-3 py-2 rounded-2 fw-semibold {{ Request::is('penjualan*') ? 'active text-white bg-primary bg-opacity-25' : 'text-secondary' }}" href="{{ route('penjualan.index') }}">
                        Penjualan
                    </a>
                </li>
            </ul>

            <div class="d-flex align-items-center mt-3 mt-lg-0">
                <form action="{{ route('logout') }}" method="POST" class="m-0 w-100">
                    @csrf
                    <button type="submit" class="btn btn-sm btn-outline-danger px-3 py-2 fw-semibold rounded-2 w-100">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<style>
    .navbar-dark .navbar-nav .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(59, 130, 246, 0.15);
    }
</style>