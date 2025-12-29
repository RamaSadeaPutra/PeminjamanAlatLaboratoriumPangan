<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Peminjaman Alat Laboratorium Teknologi Pangan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
    <!-- Decorative Background Elements -->
    <div class="absolute -top-24 -left-24 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-50"></div>
    <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-sky-100 rounded-full blur-3xl opacity-50"></div>

    <div class="relative w-full max-w-sm">
        <!-- Brand Section -->
        <div class="flex flex-col items-center mb-6">
            <div class="w-14 h-14 bg-blue-600 rounded-2xl shadow-xl shadow-blue-200 flex items-center justify-center mb-3 rotate-3 hover:rotate-0 transition-transform duration-500">
                <i data-lucide="flask-conical" class="w-7 h-7 text-white"></i>
            </div>
            <h1 class="text-lg font-extrabold text-slate-800 text-center tracking-tight leading-tight uppercase">
                Laboratorium <br> <span class="text-blue-600">Teknologi Pangan</span>
            </h1>
        </div>

        <!-- Login Card -->
        <div class="bg-white rounded-[28px] md:rounded-[32px] shadow-2xl shadow-slate-200 border border-slate-100 p-5 md:p-8 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-bl-full -mr-16 -mt-16 z-0"></div>
            
            <div class="relative z-10">
                <div class="mb-6">
                    <h2 class="text-xl font-bold text-slate-800">Selamat Datang</h2>
                    <p class="text-xs text-slate-400 font-medium">Silakan masuk ke akun Anda</p>
                </div>

                @if ($errors->any())
                    <div class="mb-6 p-4 bg-red-50 border border-red-100 rounded-2xl flex items-start gap-3">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-red-500 flex-shrink-0 mt-0.5"></i>
                        <span class="text-red-700 text-xs font-bold leading-relaxed">{{ $errors->first() }}</span>
                    </div>
                @endif

                @if (session('status'))
                    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl flex items-start gap-3">
                        <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 flex-shrink-0 mt-0.5"></i>
                        <span class="text-emerald-700 text-xs font-bold leading-relaxed">{{ session('status') }}</span>
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-4">
                    @csrf

                    <!-- EMAIL -->
                    <div class="group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Email / Username</label>
                        <div class="relative">
                            <input type="email" name="email" required autofocus
                                   class="w-full pl-11 pr-4 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-medium"
                                   placeholder="nama@email.com">
                            <i data-lucide="mail" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                        </div>
                    </div>

                    <!-- PASSWORD -->
                    <div class="group">
                        <label class="block text-xs font-bold text-slate-700 uppercase tracking-widest mb-2 px-1">Password Akun</label>
                        <div class="relative">
                            <input type="password" id="password" name="password" required
                                   class="w-full pl-11 pr-11 py-3.5 bg-slate-50 border border-slate-200 rounded-2xl text-slate-700 text-sm focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition-all placeholder:text-slate-300 font-medium"
                                   placeholder="••••••••">
                            <i data-lucide="lock" class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-slate-400 group-focus-within:text-blue-500 transition-colors"></i>
                            
                            <button type="button" onclick="togglePassword()"
                                    class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors">
                                <i data-lucide="eye-off" id="eyeIcon" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <!-- BUTTON -->
                    <button type="submit" 
                            class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-sm font-bold rounded-2xl shadow-lg shadow-blue-200 transition-all active:scale-95 flex items-center justify-center gap-3 mt-6">
                        <span>Masuk Sekarang</span>
                        <i data-lucide="arrow-right" class="w-5 h-5"></i>
                    </button>
                </form>

                <div class="mt-6 text-center">
                    <p class="text-sm text-slate-400 font-medium tracking-tight">
                        Belum memiliki akses? 
                        <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-bold transition-all">
                            Daftar Akun
                        </a>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 text-center">
            <p class="text-[10px] text-slate-400 font-bold uppercase tracking-widest leading-loose">
                © 2025 SISTEM INFORMASI LABORATORIUM <br>
                UNIVERSITAS PASUNDAN
            </p>
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword() {
            const input = document.getElementById("password");
            const icon = document.getElementById("eyeIcon");

            if (input.type === "password") {
                input.type = "text";
                icon.setAttribute("data-lucide", "eye");
            } else {
                input.type = "password";
                icon.setAttribute("data-lucide", "eye-off");
            }

            lucide.createIcons();
        }

        lucide.createIcons();
    </script>
</body>
</html>
