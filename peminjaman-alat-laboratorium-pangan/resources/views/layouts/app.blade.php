<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') | Lab Inventory</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>





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
</div>

<script>
    lucide.createIcons();
</script>
</body>
</html>
