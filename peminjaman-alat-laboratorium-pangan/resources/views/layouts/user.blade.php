<!DOCTYPE html>
<html lang="id">
<head>

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
</div>

</body>
</html>
