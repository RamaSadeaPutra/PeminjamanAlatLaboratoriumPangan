<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
<<<<<<< HEAD

    <style>
        :root {
            --primary: #2563eb;
            --danger: #dc2626;
            --warning: #f59e0b;
            --dark: #111827;
            --sidebar: #1f2937;
            --bg: #f3f4f6;
            --card: #ffffff;
        }

        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            color: #111827;
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR */
        .sidebar {
            width: 260px;
            background: var(--sidebar);
            color: white;
            padding: 24px;
        }

        .sidebar h2 {
            margin: 0 0 30px;
            font-size: 20px;
            font-weight: 600;
        }

        .sidebar a {
            display: block;
            color: #d1d5db;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 8px;
            transition: .2s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #374151;
            color: white;
        }

        /* MAIN */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        /* TOPBAR */
        .topbar {
            background: white;
            padding: 16px 32px;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .topbar h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 600;
        }

        /* CONTENT */
        .content {
            padding: 32px;
        }

        /* CARD */
        .card {
            background: var(--card);
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,.06);
        }

        /* TABLE */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 14px 16px;
            border-bottom: 1px solid #e5e7eb;
        }

        th {
            background: #f9fafb;
            text-align: left;
            font-weight: 600;
        }

        tr:hover {
            background: #f3f4f6;
        }

        /* BUTTON */
        .btn {
            padding: 8px 14px;
            border-radius: 6px;
            font-size: 14px;
            text-decoration: none;
            font-weight: 500;
            transition: .2s;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: var(--primary);
=======
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f4f6f8;
            margin: 0;
        }

        header {
            background: #2c3e50;
            color: white;
            padding: 15px 30px;
        }

        nav a {
            color: white;
            margin-right: 15px;
            text-decoration: none;
        }

        .container {
            padding: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
        }

        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }

        th {
            background: #ecf0f1;
        }

        .btn {
            padding: 6px 12px;
            text-decoration: none;
            border-radius: 4px;
            font-size: 14px;
        }

        .btn-primary {
            background: #3498db;
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
            color: white;
        }

        .btn-danger {
<<<<<<< HEAD
            background: var(--danger);
=======
            background: #e74c3c;
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
            color: white;
        }

        .btn-warning {
<<<<<<< HEAD
            background: var(--warning);
            color: white;
        }

        .btn:hover {
            opacity: .9;
        }

        .flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 16px;
=======
            background: #f39c12;
            color: white;
        }

        .card {
            background: white;
            padding: 20px;
            border-radius: 5px;
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
        }
    </style>
</head>
<body>

<<<<<<< HEAD
<!-- SIDEBAR -->
<div class="sidebar">
    <h2>Admin Panel</h2>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
        Dashboard
    </a>

    <a href="{{ route('tools.index') }}"
       class="{{ request()->routeIs('tools.*') ? 'active' : '' }}">
        Data Alat
    </a>

    <a href="{{ route('loans.index') }}"
       class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">
        Peminjaman
    </a>

    <form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit"
        class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
        Logout
    </button>
</form>
</div>

<!-- MAIN -->
<div class="main">

    <!-- TOPBAR -->
    <div class="topbar">
        <h1>@yield('title')</h1>
        <span>Admin</span>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>

=======
<header>
    <h2>Peminjaman Alat Laboratorium Pangan</h2>
    <nav>
        <a href="{{ route('tools.index') }}">Data Alat</a>
        <a href="{{ route('loans.index') }}">Peminjaman</a>
    </nav>
</header>

<div class="container">
    @yield('content')
>>>>>>> 217fe983735cfcfe26bde3416698aa585f5b1033
</div>

</body>
</html>
