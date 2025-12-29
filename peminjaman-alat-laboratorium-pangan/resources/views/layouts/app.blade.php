<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
<<<<<<< HEAD
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lab Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
=======
    <title>@yield('title')</title>

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
            color: white;
        }

        .btn-danger {
            background: var(--danger);
            color: white;
        }

        .btn-warning {
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
        }
    </style>
>>>>>>> 5c04987471bd470b2d420b3339915ec64f8d28f2
</head>

<<<<<<< HEAD




<body class="bg-slate-100 text-slate-800">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-screen">
        <div class="px-6 py-6 font-bold text-lg text-[var(--primary-blue)] flex items-center gap-2">
            <i data-lucide="flask-conical"></i>LABS PANGAN
        </div>

        <nav class="px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>

            <a href="{{ route('tools.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('tools.*') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                <i data-lucide="microscope" class="w-4 h-4"></i> Data Alat





<body class="bg-slate-100 text-slate-800">
<div class="flex min-h-screen">

    <!-- SIDEBAR -->
    <aside class="w-64 bg-white border-r border-slate-200 flex flex-col fixed h-screen">
        <div class="px-6 py-6 font-bold text-lg text-[var(--primary-blue)] flex items-center gap-2">
            <i data-lucide="flask-conical"></i>LABS PANGAN
        </div>

        <nav class="px-3 space-y-1">
            <a href="{{ route('admin.dashboard') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('admin.dashboard') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4"></i> Dashboard
            </a>

            <a href="{{ route('tools.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('tools.*') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                <i data-lucide="microscope" class="w-4 h-4"></i> Data Alat
            </a>

     <a href="{{ route('admin.loans.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('admin.loans.*') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">
                <i data-lucide="test-tubes" class="w-4 h-4"></i> Pengajuan Peminjaman

            </a>

            <a href="{{ route('loans.index') }}"
               class="flex items-center gap-3 px-4 py-2 rounded-lg
               {{ request()->routeIs('loans.*') ? 'bg-[var(--primary-blue)] text-white' : 'text-slate-600 hover:bg-slate-100' }}">

                <i data-lucide="test-tubes" class="w-4 h-4"></i> Peminjaman

                <i data-lucide="test-tubes" class="w-4 h-4"></i> Riwayat Peminjaman

            </a>
        </nav>

     <form action="{{ route('logout') }}" method="POST" class="mt-auto p-4 border-t border-slate-200">
    
    @csrf
    <button
        class="w-full flex items-center gap-3 px-4 py-2
               bg-red-500 text-white
               hover:bg-red-700
               rounded-xl font-semibold
               transition-all duration-200">
        <i data-lucide="log-out" class="w-4 h-4"></i>
        Logout
    </button>
</form>
    </aside>

    <!-- MAIN -->
    <div class="flex-1 ml-64 flex flex-col">

        <!-- TOPBAR -->
       <header class="bg-white border-b border-slate-300 px-8 py-4 flex justify-between items-center sticky top-0 z-10">
            <h1 class="font-bold text-lg">@yield('title')</h1>
            <div class="flex items-center gap-3 text-sm font-semibold text-slate-600">
                Admin
                <div class="w-9 h-9 bg-sky-100 text-sky-600 rounded-full flex items-center justify-center">
                    <i data-lucide="user-round" class="w-4 h-4"></i>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="p-8">
            @yield('content')
        </main>
    </div>
=======
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

>>>>>>> 5c04987471bd470b2d420b3339915ec64f8d28f2
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
