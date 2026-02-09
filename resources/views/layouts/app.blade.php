<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'SIPAT')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- GLOBAL CSS -->
    <style>
        :root{
            --bg-1: #f4f7fb;
            --bg-2: #eef6f4;
            --sidebar-1: #0d9488; /* teal */
            --sidebar-2: #065f46; /* dark teal */
            --accent: #c59d5f; /* elegant gold */
            --muted: #6b7280;
            --card-shadow: 0 10px 30px rgba(3,105,104,0.06);
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--bg-1), var(--bg-2));
            color: #111827;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--sidebar-1), var(--sidebar-2));
            color: #fff;
            box-shadow: 8px 0 25px rgba(2,6,23,0.08);
        }

        .sidebar h5 {
            font-weight: 700;
            letter-spacing: 1px;
        }

        .sidebar hr {
            border-color: rgba(255, 255, 255, 0.16);
        }

        .sidebar .nav-link {
            color: rgba(255,255,255,0.95);
            border-radius: 12px;
            padding: 10px 14px;
            font-size: 0.95rem;
            transition: all 0.22s ease;
        }

        .sidebar .nav-link i {
            font-size: 1.05rem;
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            transform: translateX(5px);
            color: #fff;
        }

        .sidebar .nav-link.active {
            background: #fff;
            color: var(--sidebar-2);
            font-weight: 600;
        }

        .sidebar .nav-link.active i {
            color: var(--sidebar-2);
        }

        /* ================= CONTENT ================= */
        main {
            background: transparent;
            min-height: 100vh;
            padding: 1.5rem;
        }

        /* ================= CARD ================= */
        .card {
            border: none;
            border-radius: 14px;
            box-shadow: var(--card-shadow);
        }

        .card h5 {
            font-weight: 600;
        }

        /* ================= TABLE ================= */
        .table {
            font-size: 0.95rem;
        }

        .table thead {
            background: linear-gradient(90deg, var(--sidebar-1), var(--sidebar-2));
            color: #fff;
        }

        .table thead th {
            border: none;
            white-space: nowrap;
        }

        .table tbody tr {
            transition: all 0.18s ease;
        }

        .table tbody tr:hover {
            background-color: rgba(6,95,70,0.04);
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 0.75rem;
            letter-spacing: 0.4px;
        }

        /* ================= BUTTON ================= */
        .btn {
            border-radius: 10px;
            font-size: 0.85rem;
            padding: 6px 12px;
        }

        .btn-success {
            background: linear-gradient(90deg,#16a34a,#15803d);
            border: none;
            color: #fff;
        }

        .btn-danger {
            background: linear-gradient(90deg,#ef4444,#dc2626);
            border: none;
            color: #fff;
        }

        .btn-primary {
            background: linear-gradient(90deg,var(--accent),#a07b48);
            border: none;
            color: #0b1220;
        }
    </style>

    @stack('css')
</head>

<body>

    <div class="d-flex">
        {{-- SIDEBAR --}}
        @include('layouts.sidebar')

        <div class="flex-grow-1">
            {{-- NAVBAR --}}
            @include('layouts.navbar')

            {{-- CONTENT --}}
            <main class="container-fluid p-4">
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('js')
</body>

</html>
