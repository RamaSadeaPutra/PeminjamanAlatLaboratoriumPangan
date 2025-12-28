<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Peminjaman Alat Laboratorium Teknologi Pangan</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="login-page">

    <div class="login-card" style="margin-top: 2rem; margin-bottom: 2rem;">
        <div class="brand-icon-wrapper">
            <i data-lucide="flask-conical" class="w-8 h-8"></i>
        </div>

        <h2 class="login-title">
            PENDAFTARAN AKUN BARU
        </h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- NAME -->
            <div class="login-input-group">
                <label class="login-label">Nama Lengkap</label>
                <div class="input-container">
                    <i data-lucide="user" class="input-icon"></i>
                    <input type="text"
                           name="name"
                           class="login-input"
                           placeholder="Nama Lengkap"
                           value="{{ old('name') }}"
                           required autofocus>
                </div>
                @error('name')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- NIM -->
            <div class="login-input-group">
                <label class="login-label">NIM</label>
                <div class="input-container">
                    <i data-lucide="id-card" class="input-icon"></i>
                    <input type="text"
                           name="nim"
                           class="login-input"
                           placeholder="Masukkan NIM"
                           value="{{ old('nim') }}"
                           required>
                </div>
                @error('nim')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- EMAIL -->
            <div class="login-input-group">
                <label class="login-label">Alamat Email</label>
                <div class="input-container">
                    <i data-lucide="mail" class="input-icon"></i>
                    <input type="email"
                           name="email"
                           class="login-input"
                           placeholder="contoh@lab.com"
                           value="{{ old('email') }}"
                           required>
                </div>
                @error('email')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- PASSWORD -->
            <div class="login-input-group">
                <label class="login-label">Password</label>
                <div class="input-container">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input type="password"
                           id="password"
                           name="password"
                           class="login-input pr-14"
                           placeholder="••••••••"
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password', 'eyeIcon')">
                        <i data-lucide="eye" id="eyeIcon" class="w-5 h-5"></i>
                    </button>
                </div>
                @error('password')
                    <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                @enderror
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="login-input-group">
                <label class="login-label">Konfirmasi Password</label>
                <div class="input-container">
                    <i data-lucide="lock" class="input-icon"></i>
                    <input type="password"
                           id="password_confirmation"
                           name="password_confirmation"
                           class="login-input pr-14"
                           placeholder="••••••••"
                           required>
                    <button type="button" class="password-toggle" onclick="togglePassword('password_confirmation', 'eyeIconConfirm')">
                        <i data-lucide="eye" id="eyeIconConfirm" class="w-5 h-5"></i>
                    </button>
                </div>
            </div>

            <!-- BUTTON -->
            <button type="submit" class="login-button">
                <i data-lucide="user-plus" class="w-5 h-5"></i>
                <span>Daftar</span>
            </button>
        </form>

        <div class="mt-4 text-center">
            <p class="text-sm text-gray-600">
                Sudah punya akun? 
                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-800 font-medium">
                    Login disini
                </a>
            </p>
        </div>

        <div class="login-footer">
            © 2025 Sistem Informasi Laboratorium
        </div>
    </div>

    <!-- SCRIPT -->
    <script>
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);

            if (input.type === "password") {
                input.type = "text";
                icon.setAttribute("data-lucide", "eye-off");
            } else {
                input.type = "password";
                icon.setAttribute("data-lucide", "eye");
            }

            lucide.createIcons();
        }

        lucide.createIcons();
    </script>
</body>
</html>
