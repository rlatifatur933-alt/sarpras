<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <a class="navbar-brand fw-bold text-primary" href="/">
            <span class="text-dark">SAR</span>PRASIN
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link mx-2" href="/">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link mx-2" href="#tentang"></a>
                </li>

                {{-- Cek Status Login --}}
                @auth
                    @if(auth()->user()->role == 'admin')
                        {{-- Button KHUSUS ADMIN --}}
                        <li class="nav-item">
                            <a href="/admin/dashboard" class="btn btn-primary px-4 rounded-pill">Dashboard Admin</a>
                        </li>
                    @else
                        {{-- Button KHUSUS SISWA --}}
                        <li class="nav-item ms-lg-3">
                            <a class="btn btn-primary btn-kirim-laporan" href="{{ route('aspirasi.create') }}">
                                <i class="bi bi-plus-circle me-1"></i> Kirim Laporan
                            </a>
                        </li>

                        
                    @endif

                    {{-- Dropdown Logout --}}
                    <li class="nav-item dropdown ms-lg-3">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown">
                            Hi, {{ explode(' ', auth()->user()->name)[0] }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end border-0 shadow">
                            <li>
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="bi bi-box-arrow-right me-2"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                @else
                    {{-- Button Jika BELUM LOGIN --}}
                    <li class="nav-item">
                        <a href="/login" class="btn btn-outline-primary px-4 rounded-pill ms-lg-3">Login</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>