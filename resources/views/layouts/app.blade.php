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
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #1e293b, #0f172a);
            color: #e2e8f0;
        }

        /* ================= SIDEBAR ================= */
        .sidebar {
            width: 280px;
            min-height: 100vh;
            background: linear-gradient(180deg, #1e40af 0%, #1e3a8a 50%, #1e293b 100%);
            color: #fff;
            box-shadow: 8px 0 30px rgba(0, 0, 0, 0.4);
            position: relative;
            overflow: hidden;
        }

        .sidebar::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(59, 130, 246, 0.1) 0%, transparent 50%);
            pointer-events: none;
        }

        .sidebar h5 {
            font-weight: 700;
            letter-spacing: 1px;
            color: #f1f5f9;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
            position: relative;
            z-index: 1;
        }

        .sidebar hr {
            border: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            position: relative;
            z-index: 1;
        }

        .sidebar .nav-link {
            color: #dbeafe;
            border-radius: 15px;
            padding: 12px 16px;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin-bottom: 4px;
            position: relative;
            z-index: 1;
            border: 1px solid transparent;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            margin-right: 10px;
            transition: all 0.3s ease;
        }

        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.3), rgba(37, 99, 235, 0.3));
            transform: translateX(8px) scale(1.02);
            color: #fff;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.3);
            border-color: rgba(59, 130, 246, 0.5);
        }

        .sidebar .nav-link:hover i {
            transform: scale(1.1);
            color: #60a5fa;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, #3b82f6, #2563eb);
            color: #fff;
            font-weight: 600;
            box-shadow: 0 8px 25px rgba(59, 130, 246, 0.4);
            border-color: #60a5fa;
            transform: translateX(8px);
        }

        .sidebar .nav-link.active i {
            color: #fff;
            filter: drop-shadow(0 0 8px rgba(255, 255, 255, 0.5));
        }

        .sidebar .nav-link.active::before {
            content: '';
            position: absolute;
            left: -8px;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 60%;
            background: #60a5fa;
            border-radius: 2px;
            box-shadow: 0 0 10px #60a5fa;
        }

        /* ================= CONTENT ================= */
        main {
            background: #0f172a;
            min-height: 100vh;
            border-radius: 30px 0 0 30px;
        }

        /* ================= CARD ================= */
        .card {
            background: #1e293b;
            border: 1px solid #334155;
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            color: #e2e8f0;
        }

        .card h5 {
            font-weight: 600;
            color: #f1f5f9;
        }

        /* ================= TABLE ================= */
        .table {
            font-size: 0.9rem;
            color: #e2e8f0;
        }

        .table thead {
            background: linear-gradient(90deg, #1e40af, #1e3a8a);
            color: #fff;
        }

        .table thead th {
            border: none;
            white-space: nowrap;
        }

        .table tbody tr {
            background: #1e293b;
            border-bottom: 1px solid #334155;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #334155;
        }

        /* ================= BADGE ================= */
        .badge {
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 0.7rem;
            letter-spacing: 0.5px;
        }

        /* ================= BUTTON ================= */
        .btn {
            border-radius: 12px;
            font-size: 0.75rem;
            padding: 6px 14px;
            border: none;
        }

        .btn-success {
            background: linear-gradient(90deg, #059669, #047857);
        }

        .btn-danger {
            background: linear-gradient(90deg, #dc2626, #b91c1c);
        }

        .btn-primary {
            background: linear-gradient(90deg, #2563eb, #1d4ed8);
        }

        .btn-outline-primary {
            border-color: #3b82f6;
            color: #3b82f6;
        }

        .btn-outline-primary:hover {
            background: #3b82f6;
            color: #fff;
        }

        /* ================= NAVBAR ================= */
        .navbar {
            background: linear-gradient(90deg, #1e40af, #1e3a8a, #1e40af);
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
            border-bottom: 1px solid #3b82f6;
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .navbar-brand {
            color: #fff !important;
            font-weight: 700;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
        }

        .dropdown-menu {
            background: rgba(30, 58, 138, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid #3b82f6;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        .dropdown-item {
            color: #e2e8f0;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(59, 130, 246, 0.2);
            color: #fff;
        }

        .btn-outline-primary {
            border-color: #60a5fa;
            color: #60a5fa;
            transition: all 0.3s ease;
        }

        .btn-outline-primary:hover {
            background: linear-gradient(90deg, #3b82f6, #1d4ed8);
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.4);
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
