<nav class="custom-navbar py-2">
    <style>
        .custom-navbar{backdrop-filter: blur(6px);background:linear-gradient(180deg, rgba(255,255,255,0.6), rgba(255,255,255,0.35));border-radius:14px;padding:6px 12px;margin:10px;box-shadow:0 6px 22px rgba(2,6,23,0.06)}
        .custom-brand{display:flex;align-items:center;gap:12px}
        .brand-logo{width:46px;height:46px;border-radius:10px;display:inline-flex;align-items:center;justify-content:center;color:#fff;font-weight:700;font-family:Inter;background:linear-gradient(135deg,#6ee7b7,#06b6d4);transform:rotate(-8deg);box-shadow:0 6px 18px rgba(6,182,212,0.12)}
        .brand-title{font-weight:700;letter-spacing:0.6px;color:#0f172a}
        .nav-search{min-width:280px}
        .nav-search .form-control{border-radius:999px;background:rgba(15,23,42,0.04);border:1px solid rgba(2,6,23,0.04)}
        .nav-actions .btn{border-radius:10px}
        .notif-dot{position:relative}
        .notif-dot::after{content:'';position:absolute;top:4px;right:6px;width:10px;height:10px;border-radius:50%;background:#ef4444;border:2px solid #fff}
        @media (max-width:768px){ .nav-search{display:none} }
    </style>

    <div class="container-fluid d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <div class="custom-brand">
                <a href="/" class="d-flex align-items-center text-decoration-none">
                    <div class="brand-logo">A</div>
                    <div>
                        <div class="brand-title">SIPAT</div>
                        <small class="text-muted">Sistem Peminjaman</small>
                    </div>
                </a>
            </div>
        </div>

        <div class="nav-search d-none d-md-block">
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Cari alat, peminjam..." aria-label="Search">
                <button class="btn btn-outline-secondary" type="submit"><i class="bi bi-search"></i></button>
            </form>
        </div>

        <div class="nav-actions d-flex align-items-center gap-2">
            <a href="#" class="btn btn-light btn-sm notif-dot" title="Notifikasi"><i class="bi bi-bell"></i></a>

            @auth
                <div class="dropdown">
                    <a class="d-flex align-items-center text-decoration-none dropdown-toggle" href="#" data-bs-toggle="dropdown">
                        <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:38px;height:38px">{{ strtoupper(substr(auth()->user()->name,0,1)) }}</div>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end shadow">
                        <li class="px-3 py-2 text-muted small">Login sebagai<br><strong>{{ auth()->user()->role }}</strong></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Profil</a></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endauth

            @guest
                <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Login</a>
            @endguest
        </div>
    </div>
</nav>
