<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">Toko Online</a>
            <div class="collapse navbar-collapse">
                <ul class="navbar-nav ms-auto">
                    @auth
                        @if(auth()->user()->role == 'admin')
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/categories">Kategori</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/products">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/admin/orders">Order</a>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="/products">Produk</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/cart">Keranjang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="/orders">Riwayat Order</a>
                            </li>
                        @endif
                        <li class="nav-item">
                            <span class="nav-link text-white">{{ auth()->user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
       @yield('content')
    </div>
</body>
</html>
