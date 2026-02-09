<nav class="navbar navbar-expand-lg px-4 py-3">
    <div class="container-fluid d-flex align-items-center">

        <!-- Elegant Brand Section -->
        <div class="d-flex align-items-center">
            <div class="brand-icon me-3">
                <i class="bi bi-house-door-fill fs-4"></i>
            </div>
            <div>
                <h5 class="mb-0 fw-bold">@yield('page_title', 'Dashboard')</h5>
                <small class="text-muted">Sistem Peminjaman Alat</small>
            </div>
        </div>

        <!-- Spacer -->
        <div class="flex-grow-1"></div>

        <!-- Elegant User Section -->
        <div class="d-flex align-items-center gap-3">

            <!-- Notification Bell (Optional) -->
            <button class="btn btn-link text-light position-relative" type="button">
                <i class="bi bi-bell-fill fs-5"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size: 0.6rem;">
                    3
                </span>
            </button>

            <!-- User Dropdown -->
            <div class="dropdown">

                @auth
                    <button class="btn btn-elegant d-flex align-items-center gap-2"
                            type="button"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <div class="avatar-circle me-2">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="text-start">
                            <div class="fw-semibold">{{ auth()->user()->name }}</div>
                            <small class="text-muted">{{ ucfirst(auth()->user()->role) }}</small>
                        </div>
                        <i class="bi bi-chevron-down ms-2"></i>
                    </button>

                    <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0">
                        <li class="px-3 py-3">
                            <div class="d-flex align-items-center">
                                <div class="avatar-circle me-3">
                                    <i class="bi bi-person-circle"></i>
                                </div>
                                <div>
                                    <div class="fw-semibold">{{ auth()->user()->name }}</div>
                                    <small class="text-muted">{{ auth()->user()->email ?? 'No email' }}</small>
                                </div>
                            </div>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <i class="bi bi-gear me-2"></i> Pengaturan
                            </a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Logout
                                </button>
                            </form>
                        </li>
                    </ul>
                @endauth

                @guest
                    <a href="{{ route('login') }}" class="btn btn-elegant">
                        <i class="bi bi-box-arrow-in-right me-2"></i> Login
                    </a>
                @endguest

            </div>

        </div>

    </div>
</nav>
