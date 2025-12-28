<!DOCTYPE html>
<html lang="id">
<head>

  @vite(['resources/css/app.css', 'resources/js/app.js'])
    <meta charset="UTF-8">
    <title>@yield('title')</title>

 
    <script src="https://unpkg.com/lucide@latest"></script>
</head>

<body>

<!-- ================= SIDEBAR ================= -->
<div class="sidebar flex flex-col gap-2">
    <h2>🔬 LAB USER</h2>

    <a href="{{ route('user.tools.index') }}"
       class="{{ request()->routeIs('user.tools.*') ? 'active' : '' }}">
        <i data-lucide="microscope"></i> Daftar Alat
    </a>
 <a href="{{ route('user.loans.index') }}"
       class="{{ (request()->routeIs('user.loans.index') || request()->routeIs('user.loans.create') || request()->routeIs('user.loans.store')) ? 'active' : '' }}">
        <i data-lucide="test-tubes"></i> Pinjaman Saya
    </a>
    <a href="{{ route('user.loans.history') }}"
       class="{{ request()->routeIs('user.loans.history') ? 'active' : '' }}">
        <i data-lucide="history"></i> Riwayat Peminjaman
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
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
