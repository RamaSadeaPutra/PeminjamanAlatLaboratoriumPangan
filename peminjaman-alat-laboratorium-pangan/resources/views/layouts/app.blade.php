<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lab-Inventory</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        :root {
            /* Palette: Biru, Putih, Abu */
            --primary-blue: #2563eb;    /* Biru Utama */
            --light-blue: #eff6ff;      /* Biru Muda untuk Background Active */
            --pure-white: #ffffff;      /* Putih */
            --bg-gray: #f1f5f9;         /* Abu-abu sangat muda untuk Background */
            --border-gray: #e2e8f0;     /* Abu-abu untuk Garis/Border */
            --text-main: #1e293b;       /* Abu-abu gelap untuk teks utama */
            --text-gray: #64748b;       /* Abu-abu sedang untuk teks pendukung */
            --sidebar-gray: #f8fafc;    /* Abu-abu putih untuk Sidebar */
            --danger-red: #ef4444;
        }

        * {
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
        }

        body {
            margin: 0;
            background: var(--bg-gray);
            color: var(--text-main);
            display: flex;
            min-height: 100vh;
        }

        /* SIDEBAR (Warna Abu-abu Terang & Putih) */
        .sidebar {
            width: 260px;
            background: var(--sidebar-gray);
            border-right: 1px solid var(--border-gray);
            color: var(--text-main);
            padding: 24px 16px;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100vh;
        }

        .sidebar h2 {
            margin: 0 0 32px;
            font-size: 20px;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 0 12px;
            color: var(--primary-blue);
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--text-gray);
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 4px;
            transition: all .2s;
            font-size: 15px;
            font-weight: 500;
        }

        .sidebar a:hover {
            background: var(--border-gray);
            color: var(--text-main);
        }

        .sidebar a.active {
            background: var(--primary-blue);
            color: var(--pure-white);
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }

        .logout-form {
            margin-top: auto;
            border-top: 1px solid var(--border-gray);
            padding-top: 16px;
        }

        .btn-logout {
            width: 100%;
            background: transparent;
            border: none;
            color: var(--text-gray);
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 500;
            border-radius: 10px;
            transition: .2s;
        }

        .btn-logout:hover {
            background: #fff1f2;
            color: var(--danger-red);
        }

        /* MAIN AREA */
        .main {
            flex: 1;
            display: flex;
            flex-direction: column;
            margin-left: 260px;
        }

        /* TOPBAR (Putih Bersih) */
        .topbar {
            background: var(--pure-white);
            padding: 16px 32px;
            border-bottom: 1px solid var(--border-gray);
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 10;
        }

        .topbar h1 {
            margin: 0;
            font-size: 18px;
            font-weight: 700;
            color: var(--text-main);
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-gray);
        }

        .user-avatar {
            width: 35px;
            height: 35px;
            background: var(--light-blue);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--primary-blue);
            border: 1px solid var(--border-gray);
        }

        /* CONTENT AREA */
        .content {
            padding: 32px;
        }

        /* CARD (Putih dengan Bayangan Abu-abu Halus) */
        .card {
            background: var(--pure-white);
            padding: 24px;
            border-radius: 12px;
            border: 1px solid var(--border-gray);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        /* Tombol Biru */
        .btn-primary {
            background: var(--primary-blue);
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            transition: 0.3s;
        }

        .btn-primary:hover {
            background: #1d4ed8;
            transform: translateY(-1px);
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2><i data-lucide="flask-conical"></i> LABORATORIUM PANGAN</h2>

    <a href="{{ route('admin.dashboard') }}"
       class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
       <i data-lucide="layout-dashboard" size="18"></i> Dashboard
    </a>

    <a href="{{ route('tools.index') }}"
       class="{{ request()->routeIs('tools.*') ? 'active' : '' }}">
       <i data-lucide="microscope" size="18"></i> Data Alat
    </a>

    <a href="{{ route('loans.index') }}"
       class="{{ request()->routeIs('loans.*') ? 'active' : '' }}">
       <i data-lucide="test-tubes" size="18"></i> Peminjaman
    </a>

    <form action="{{ route('logout') }}" method="POST" class="logout-form">
        @csrf
        <button type="submit" class="btn-logout">
            <i data-lucide="log-out" size="18"></i> Logout
        </button>
    </form>
</div>

<div class="main">
    <div class="topbar">
        <h1>@yield('title')</h1>
        <div class="user-profile">
            <span>Admin</span>
            <div class="user-avatar">
                <i data-lucide="user-round" size="18"></i>
            </div>
        </div>
    </div>

    <div class="content">
        @yield('content')
    </div>
</div>

<script>
    // Inisialisasi ikon Lucide
    lucide.createIcons();
</script>

</body>
</html>