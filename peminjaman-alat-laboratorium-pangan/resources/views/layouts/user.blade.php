<!DOCTYPE html>
<html lang="id">
<head>
<<<<<<< HEAD

  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>@yield('title')</title>

 
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar">
    <h2>🔬 LAB USER</h2>

    <a href="{{ route('user.tools.index') }}"
       class="{{ request()->routeIs('user.tools.*') ? 'active' : '' }}">
        📦 Daftar Alat
    </a>
 <a href=""
       class="">
        📦 Pinjaman Saya
    </a>
    <a href=""
       class="{{ request()->routeIs('user.loans.*') ? 'active' : '' }}">
        📄 Riwayat Peminjaman
    </a>

     <form action="{{ route('logout') }}" method="POST" class="mt-90 p-4 border-t border-slate-200">
    
    @csrf
    <button
        class="w-full flex items-center gap-9 px-4 py-2
               bg-red-500 text-white
               hover:bg-red-700
               rounded-xl font-semibold
               transition-all duration-200">
        <i data-lucide="log-out" class="w-4 h-4"></i>
        Logout
    </button>
</form>
</div>

<!-- ================= MAIN ================= -->
<div class="main">
    <div class="usermain">    
    <!-- TOPBAR -->
    <div class="topbar">
        <h1>@yield('title')</h1>

        <div class="user-info">
            {{ auth()->user()->name ?? 'User' }}
            <div class="user-avatar">
                {{ strtoupper(substr(auth()->user()->name ?? 'U',0,1)) }}
            </div>
        </div>
    </div>

    <!-- CONTENT -->
    <div class="content">
        @yield('content')
    </div>
</div> 
=======
    <meta charset="UTF-8">
    <title>@yield('title')</title>

    <style>
        :root {
            --primary: #16a34a;
            --dark: #064e3b;
            --bg: #f0fdf4;
            --card: #ffffff;
        }

        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: var(--bg);
            color: #064e3b;
        }

        header {
            background: var(--dark);
            color: white;
            padding: 18px 32px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        header h2 {
            margin: 0;
            font-size: 20px;
        }

        nav a {
            color: #d1fae5;
            text-decoration: none;
            margin-left: 16px;
            font-weight: 500;
        }

        nav a:hover {
            color: white;
            text-decoration: underline;
        }

        .container {
            padding: 32px;
        }

        .grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
            gap: 24px;
        }

        .card {
            background: var(--card);
            padding: 20px;
            border-radius: 14px;
            box-shadow: 0 10px 20px rgba(0,0,0,.06);
        }

        .card h3 {
            margin-top: 0;
        }

        .badge {
            display: inline-block;
            padding: 4px 10px;
            font-size: 12px;
            border-radius: 999px;
            background: #dcfce7;
            color: #166534;
            margin-bottom: 10px;
        }

        .btn {
            display: inline-block;
            padding: 10px 16px;
            background: var(--primary);
            color: white;
            text-decoration: none;
            border-radius: 8px;
            margin-top: 14px;
            font-size: 14px;
        }

        .btn:hover {
            opacity: .9;
        }
    </style>
</head>
<body>

<header>
    <h2>User · Peminjaman Alat Lab Pangan</h2>
    <nav>
        <a href="{{ route('user.tools.index') }}">Daftar Alat</a>
    </nav>
</header>

<div class="container">
    @yield('content')
>>>>>>> 5c04987471bd470b2d420b3339915ec64f8d28f2
</div>

</body>
</html>
