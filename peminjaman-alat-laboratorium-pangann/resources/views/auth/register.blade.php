<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Peminjaman Alat Laboratorium Teknologi Pangan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex items-center justify-center p-4 lg:p-10 relative overflow-hidden">

    <!-- Background Blur -->
    <div class="absolute -top-48 -left-48 w-125 h-125 bg-blue-100 rounded-full blur-[120px] opacity-40"></div>
    <div class="absolute -bottom-48 -right-48 w-125 h-125 bg-sky-100 rounded-full blur-[120px] opacity-40"></div>

    <div class="relative w-full max-w-lg">

        <!-- Brand -->
        <div class="flex flex-col items-center mb-6">
            <div class="w-14 h-14 mb-3 bg-blue-600 rounded-3xl shadow-xl shadow-blue-200 flex items-center justify-center -rotate-6 hover:rotate-0 transition-all duration-700">
                <i data-lucide="flask-conical" class="w-7 h-7 text-white"></i>
            </div>

            <h1 class="text-lg font-black text-slate-800 text-center tracking-tighter leading-tight uppercase">
                Pembuatan Akun <br>
                <span class="text-blue-600">
                    Peminjaman Alat Laboratorium Teknologi Pangan
                </span>
            </h1>
        </div>

        <!-- Card -->
        <div class="bg-white rounded-3xl shadow-2xl shadow-slate-200 border border-slate-100 p-5 md:p-7 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-40 h-40 bg-slate-50 rounded-bl-full -mr-20 -mt-20"></div>

            <div class="relative z-10">

                <div class="mb-5">
                    <h2 class="text-xl font-extrabold text-slate-800">
                        Daftar Sekarang
                    </h2>
                    <p class="text-xs text-slate-400 font-medium mt-1">
                        Lengkapi data diri untuk akses laboratorium
                    </p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                        <!-- Nama -->
                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.18em] mb-1 px-1">
                                Nama Lengkap
                            </label>
                            <div class="relative">
                                <input type="text" name="name" value="{{ old('name') }}" required autofocus
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-[18px] text-[13px] font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none"
                                    placeholder="Nama Lengkap">
                                <i data-lucide="user" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            </div>
                            @error('name')
                                <p class="mt-1 text-red-500 text-[10px] font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIM -->
                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.18em] mb-1 px-1">
                                NIM / ID
                            </label>
                            <div class="relative">
                                <input type="text" name="nim" value="{{ old('nim') }}" required
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-[18px] text-[13px] font-bold font-mono focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none"
                                    placeholder="123456789">
                                <i data-lucide="id-card" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            </div>
                            @error('nim')
                                <p class="mt-1 text-red-500 text-[10px] font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="group md:col-span-2">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.18em] mb-1 px-1">
                                Email Kampus
                            </label>
                            <div class="relative">
                                <input type="email" name="email" value="{{ old('email') }}" required
                                    class="w-full pl-10 pr-4 py-3 bg-slate-50 border border-slate-200 rounded-[18px] text-[13px] font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none"
                                    placeholder="student@mail.unpas.ac.id">
                                <i data-lucide="mail" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                            </div>
                            @error('email')
                                <p class="mt-1 text-red-500 text-[10px] font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.18em] mb-1 px-1">
                                Password
                            </label>
                            <div class="relative">
                                <input type="password" id="password" name="password" required
                                    class="w-full pl-10 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-[18px] text-[13px] font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none"
                                    placeholder="••••••••">
                                <i data-lucide="lock" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                                <button type="button" onclick="togglePassword('password','icon-pass')"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i id="icon-pass" data-lucide="eye-off" class="w-4 h-4"></i>
                                </button>
                            </div>
                            @error('password')
                                <p class="mt-1 text-red-500 text-[10px] font-bold">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="group">
                            <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.18em] mb-1 px-1">
                                Konfirmasi Password
                            </label>
                            <div class="relative">
                                <input type="password" id="password_confirmation" name="password_confirmation" required
                                    class="w-full pl-10 pr-12 py-3 bg-slate-50 border border-slate-200 rounded-[18px] text-[13px] font-bold focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none"
                                    placeholder="••••••••">
                                <i data-lucide="shield-check" class="absolute left-3.5 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400"></i>
                                <button type="button" onclick="togglePassword('password_confirmation','icon-pass-confirm')"
                                    class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400">
                                    <i id="icon-pass-confirm" data-lucide="eye-off" class="w-4 h-4"></i>
                                </button>
                            </div>
                        </div>

                    </div>

                    <button type="submit"
                        class="w-full py-3.5 bg-blue-600 hover:bg-blue-700 text-white text-xs font-black uppercase tracking-widest rounded-3xl shadow-xl shadow-blue-200 transition-all active:scale-[0.98] mt-5">
                        Daftar Sekarang
                    </button>
                </form>

                <div class="mt-5 text-center text-xs text-slate-400">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-blue-600 font-bold hover:underline">
                        Login
                    </a>
                </div>

            </div>
        </div>

        <div class="mt-6 text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest">
            © 2025 Sistem Peminjaman Alat Laboratorium Teknologi Pangan<br>
            Universitas Pasundan
        </div>

    </div>

    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            input.type = input.type === "password" ? "text" : "password";
            icon.setAttribute("data-lucide", input.type === "password" ? "eye-off" : "eye");
            lucide.createIcons();
        }
        lucide.createIcons();
    </script>

</body>
</html>
