<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Inventaris Lab Pangan | Home</title>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .hero-gradient {
            background: radial-gradient(circle at 0% 0%, rgba(37, 99, 235, 0.1) 0%, transparent 40%),
                        radial-gradient(circle at 100% 100%, rgba(14, 165, 233, 0.1) 0%, transparent 40%);
        }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased hero-gradient min-h-screen flex flex-col">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-md border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 h-20 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-200">
                    <i data-lucide="flask-conical" class="w-6 h-6 text-white"></i>
                </div>
                <div>
                    <span class="block text-lg font-black text-slate-800 tracking-tight leading-none uppercase">LAB <span class="text-blue-600">PANGAN</span></span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-0.5 block">Inventory System</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 text-sm">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-6 py-2.5 text-slate-600 font-bold hover:text-blue-600 transition-colors text-sm">
                            Masuk
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-blue-600 text-white font-bold rounded-xl shadow-lg shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 text-sm">
                                Daftar Sekarang
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

            <!-- Mobile Menu Toggle (Simplified for landing) -->
            <div class="md:hidden">
                <a href="{{ route('login') }}" class="p-2 text-blue-600">
                    <i data-lucide="log-in" class="w-6 h-6"></i>
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <main class="flex-1 flex flex-col items-center justify-center text-center px-6 py-20">
        <div class="max-w-4xl mx-auto space-y-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-xs font-black uppercase tracking-widest border border-blue-100 animate-fade-in">
                <span class="w-1.5 h-1.5 rounded-full bg-blue-500 animate-pulse"></span>
                Manajemen Lab yang Lebih Efisien
            </div>

            <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-slate-900 tracking-tighter leading-[1.1]">
                Kelola Inventaris Alat <br> 
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-sky-500">Lebih Mudah & Terukur</span>
            </h1>

            <p class="text-lg md:text-xl text-slate-500 font-medium max-w-2xl mx-auto leading-relaxed">
                Sistem informasi peminjaman dan pengelolaan alat laboratorium Teknologi Pangan. Pantau stok, kondisi, dan riwayat peminjaman dalam satu platform terintegrasi.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4 pt-6">
                @auth
                    <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-10 py-4 bg-slate-900 text-white font-bold rounded-2xl shadow-2xl shadow-slate-200 hover:bg-slate-800 transition-all active:scale-95 flex items-center justify-center gap-3 text-lg">
                        Ke Dashboard
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </a>
                @else
                    <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-4 bg-blue-600 text-white font-bold rounded-2xl shadow-2xl shadow-blue-200 hover:bg-blue-700 transition-all active:scale-95 flex items-center justify-center gap-3 text-lg">
                        Mulai Sekarang
                        <i data-lucide="rocket" class="w-5 h-5"></i>
                    </a>
                    <a href="{{ route('login') }}" class="w-full sm:w-auto px-10 py-4 bg-white text-slate-700 font-bold rounded-2xl border border-slate-200 hover:border-blue-200 hover:text-blue-600 transition-all active:scale-95 text-lg">
                        Masuk Akun
                    </a>
                @endauth
            </div>
        </div>
    </main>

    <!-- Features Mini -->
    <section class="max-w-7xl mx-auto px-6 py-20 w-full">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-50 transition-all duration-300">
                <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="search" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Live Search</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Cari alat laboratorium yang Anda butuhkan secara instan dengan fitur pencarian cepat kami.</p>
            </div>

            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-50 transition-all duration-300">
                <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="shield-check" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Sistem Approval</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Pengelolaan peminjaman yang terorganisir dengan sistem persetujuan admin yang transparan.</p>
            </div>

            <div class="p-8 bg-white rounded-3xl border border-slate-100 shadow-sm hover:shadow-xl hover:shadow-blue-50 transition-all duration-300">
                <div class="w-12 h-12 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center mb-6">
                    <i data-lucide="bar-chart-3" class="w-6 h-6"></i>
                </div>
                <h3 class="text-xl font-bold text-slate-800 mb-3">Statistik Riwayat</h3>
                <p class="text-slate-500 text-sm leading-relaxed">Pantau semua aktivitas penggunaan alat laboratorium secara akurat dan terdokumentasi.</p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="border-t border-slate-100 py-10">
        <div class="max-w-7xl mx-auto px-6 text-center">
            <p class="text-slate-400 text-sm font-medium">
                &copy; {{ date('Y') }} Lab Pangan Inventory System. Built with ❤️ for Laboratory Management.
            </p>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
