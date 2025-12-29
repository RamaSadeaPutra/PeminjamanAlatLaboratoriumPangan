<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lab Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .sidebar-glow { background-image: radial-gradient(circle at 100% 0%, rgba(37, 99, 235, 0.05) 0%, transparent 50%); }
    </style>
</head>

<body class="bg-slate-50 text-slate-800 antialiased">
<div class="min-h-screen">

    <!-- BACKDROP (Mobile only) -->
    <div id="sidebar-overlay" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm z-40 hidden lg:hidden"></div>

    <!-- SIDEBAR -->
    <aside id="main-sidebar" class="w-72 bg-white border-r border-slate-200 flex flex-col fixed h-screen z-50 transition-all duration-300 sidebar-glow -translate-x-full lg:translate-x-0">
        <div class="px-8 py-10">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200 rotate-3 group-hover:rotate-0 transition-transform">
                    <i data-lucide="flask-conical" class="w-6 h-6 text-white text-bold"></i>
                </div>
                <div>
                    <span class="block text-lg font-black text-slate-800 tracking-tight leading-none uppercase">LAB <span class="text-blue-600">PANGAN</span></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1 block">Inventory System</span>
                </div>
            </div>
        </div>

        <nav class="flex-1 px-4 space-y-1.5 overflow-y-auto custom-scrollbar">
            <div class="px-4 pb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Menu Utama</span>
            </div>

            <a href="{{ route('admin.dashboard') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="layout-dashboard" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Dashboard</span>
            </a>

            <a href="{{ route('tools.index') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('tools.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="microscope" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Inventaris Alat</span>
            </a>

            <div class="px-4 pt-6 pb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Peminjaman</span>
            </div>

            <a href="{{ route('admin.loans.index') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ (request()->routeIs('admin.loans.index') || request()->routeIs('admin.loans.approve') || request()->routeIs('admin.loans.reject')) ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="git-pull-request" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Menunggu Approval</span>
            </a>

            <a href="{{ route('admin.loans.history') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('admin.loans.history') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="history" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Riwayat Pinjam</span>
            </a>

            <div class="px-4 pt-6 pb-2">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">User & Security</span>
            </div>

                <a href="{{ route('admin.users.pending') }}"
                    class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
                    {{ request()->routeIs('admin.users.pending') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="user-plus-2" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Verifikasi Akun</span>
            </a>

            <a href="{{ route('admin.users.active') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('admin.users.active') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="users" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Pengguna Aktif</span>
            </a>

            <a href="{{ route('admin.users.history') }}"
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('admin.users.history') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="clock" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Riwayat Registrasi</span>
            </a>

            <a href="{{ route('profile.show') }}" 
               class="group flex items-center gap-3.5 px-4 py-3 rounded-2xl transition-all duration-300
               {{ request()->routeIs('profile.*') ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 font-bold' : 'text-slate-500 hover:bg-slate-50 hover:text-blue-600' }}">
                <i data-lucide="shield-check" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
                <span class="text-sm">Settings Profile</span>
            </a>
        </nav>

        <div class="p-4 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="w-full group flex items-center justify-center gap-3 px-4 py-4 bg-red-50 text-red-600 hover:bg-red-600 hover:text-white rounded-[22px] font-bold text-xs uppercase tracking-widest transition-all duration-300 active:scale-95 border border-red-100">
                    <i data-lucide="log-out" class="w-4 h-4 group-hover:-translate-x-1 transition-transform"></i>
                    Keluar Sistem
                </button>
            </form>
        </div>
    </aside>

    <!-- MAIN -->
    <div id="main-content" class="ml-0 lg:ml-72 flex flex-col min-h-screen transition-all duration-300">

        <!-- TOPBAR -->
       <header class="bg-white/80 backdrop-blur-md border-b border-slate-200 px-4 md:px-10 py-5 flex justify-between items-center sticky top-0 z-40">
            <div class="flex items-center gap-4">
                <!-- Mobile Menu Toggle -->
                <button id="sidebar-toggle" class="lg:hidden p-2 text-slate-500 hover:bg-slate-50 rounded-xl transition-all">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div class="flex flex-col">
                    <h1 class="font-extrabold text-xl text-slate-800 tracking-tight">@yield('title')</h1>
                    <div class="flex items-center gap-2 mt-0.5">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Sistem Online</span>
                    </div>
                </div>
            </div>
            
            <div class="flex items-center gap-6">
                <!-- Search Button (Optional/Visual) -->
                

                <div class="h-8 w-[1px] "></div>

                <div class="flex items-center gap-4">
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-black text-slate-800 tracking-tight">{{ auth()->user()->name }}</span>
                        <span class="text-[10px] font-bold text-blue-600 uppercase tracking-widest">Administrator</span>
                    </div>
                    <div class="w-11 h-11 bg-slate-100 rounded-2xl flex items-center justify-center border-2 border-white shadow-sm overflow-hidden group hover:border-blue-100 transition-all cursor-pointer">
                        @if(auth()->user()->photo_path)
                            <img src="{{ asset('storage/' . auth()->user()->photo_path) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform">
                        @else
                            <i data-lucide="user-round" class="w-5 h-5 text-slate-400 group-hover:text-blue-500 transition-colors"></i>
                        @endif
                    </div>
                </div>
            </div>
        </header>

        <!-- CONTENT -->
        <main class="@yield('main_class', 'p-10') flex-1">
            @yield('content')
        </main>
    </div>
</div>

<script>
    lucide.createIcons();

    // Mobile Sidebar Toggle Logic
    const sidebar = document.getElementById('main-sidebar');
    const toggleBtn = document.getElementById('sidebar-toggle');
    const overlay = document.getElementById('sidebar-overlay');

    function toggleSidebar() {
        sidebar.classList.toggle('-translate-x-full');
        overlay.classList.toggle('hidden');
        document.body.classList.toggle('overflow-hidden');
    }

    if (toggleBtn) {
        toggleBtn.addEventListener('click', toggleSidebar);
    }

    if (overlay) {
        overlay.addEventListener('click', toggleSidebar);
    }
</script>
</body>
</html>
